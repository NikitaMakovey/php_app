<?php


namespace App;

use Symfony\Component\DomCrawler\Crawler;
use DateTime;

class CouponParser
{
    const COUPON_PARAMS = array(
        "param__root_path"  => "//div[@class='promo-container']/div[@class='promo-block promo-block-teaser']/div[@class='spacer']",
        "param__title"      => "//h2//a//span",
        "param__link"       => "//h2//a/@href",
        "param__image"      => "//div[@class='promo-image']//a//img/@src",
        "param__validity"   => "//div[@class='section fsize11 grey-6 tahoma']/div[@class='section-left']",
        "param__end_sale"   => "//nobr",
        "param__count_cs"   => "//div[@class='coupons-count']//strong"
    );

    const MONTH_PARAMS = array(
        "янв."  => "01",
        "фев."  => "02",
        "мар."  => "03",
        "апр."  => "04",
        "май"   => "05",
        "июн."  => "06",
        "июл."  => "07",
        "авг."  => "08",
        "сент." => "09",
        "окт."  => "10",
        "нояб." => "11",
        "дек."  => "12",
    );

    /**
     * @var string
     */
    private $city = "vladivostok";

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @var string
     */
    private $link;

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = "https://{$this->getCity()}.lovikupon.ru/today/";
    }

    /**
     * @var Database
     */
    private $db;

    /**
     * @return Database
     */
    public function getDb(): Database
    {
        return $this->db;
    }

    /**
     * @param Database $db
     */
    public function setDb(Database $db): void
    {
        $this->db = $db;
    }

    /**
     * CouponParser constructor.
     * @param $city
     */
    public function __construct($city)
    {
        $city = lcfirst($city);
        $this->setCity($city);
        $db = new Database($this->getCity());
        $this->setDb($db);
        $this->setLink($city);
    }

    /**
     * @param $data
     */
    public function console_log($data)
    {
        echo '<script>';
        echo 'console.log('. json_encode($data) .')';
        echo '</script>';
    }

    /**
     * @param $validity_text
     * @return int
     */
    public function getDateTimeLength($validity_text) : int
    {
        preg_match_all(
            "/[0-9]+|(янв.|фев.|март.|апр.|мая|июн.|июл.|авг.|сент.|окт.|нояб.|дек.)/", $validity_text, $matches
        );
        $year_before    = date("Y");
        $year_after     = date("Y");
        $month_before   = self::MONTH_PARAMS[$matches[0][1]];
        $month_after    = self::MONTH_PARAMS[$matches[0][3]];
        if (intval($month_after) < intval($month_before))
        {
            $year_after++;
        }
        $day_before     = $matches[0][0];
        $day_after      = $matches[0][2];
        $date_before    = "{$year_before}-{$month_before}-{$day_before}";
        $date_after     = "{$year_after}-{$month_after}-{$day_after}";
        try {
            $date_1 = new DateTime($date_before);
        } catch (\Exception $e) {
            die("DATETIME ERROR ($e)");
        }
        try {
            $date_2 = new DateTime($date_after);
        } catch (\Exception $e) {
            die("DATETIME ERROR ($e)");
        }
        $validity_length
            = $date_1->diff($date_2)->days;
        return $validity_length;
    }

    /**
     * @param $sale_end
     * @return string
     */
    public function getEndSaleDate($sale_end)
    {
        $current_date = date("Y-m-d H:i:s");
        preg_match_all("/[0-9]+/", $sale_end, $matches);
        try {
            $date = new DateTime($current_date);
        } catch (\Exception $e) {
            die("DATETIME ERROR ($e)");
        }
        $date->modify("+{$matches[0][0]} day +{$matches[0][1]} hour +{$matches[0][2]} minutes +{$matches[0][3]} seconds");
        $end_sale_date = $date->format("Y-m-d H:i:s");
        return $end_sale_date;
    }

    /**
     * @param Crawler $crawler
     * @return int
     */
    public function getCountCoupons(Crawler $crawler) : int
    {
        $coupons = $crawler->filterXPath(self::COUPON_PARAMS["param__count_cs"])->each(function (Crawler $node, $i) {
            static $result = 0;
            $result += intval($node->text());
            return $result;
        });
        return end($coupons);
    }

    /**
     * @return int
     */
    public function inputData() : int
    {
        $html = file_get_contents($this->getLink());
        $crawler = new Crawler(null, $this->getLink());
        $crawler->addHtmlContent($html, "UTF-8");

        $crawler->filterXPath(self::COUPON_PARAMS["param__root_path"])->each(function (Crawler $node, $i)
        {
            $column__title
                = trim($node->filterXPath(self::COUPON_PARAMS["param__title"])->text());
            $column__link
                = "https://{$this->getCity()}.lovikupon.ru".$node->filterXPath(self::COUPON_PARAMS["param__link"])->text();
            $column__src_image
                = $node->filterXPath(self::COUPON_PARAMS["param__image"])->text();

            if (!is_null($node->filterXPath(self::COUPON_PARAMS["param__validity"])->text()))
            {
                $column__validity_text
                    = trim(preg_replace("/\s{2,}/", " ", $node->filterXPath(self::COUPON_PARAMS["param__validity"])->text()));
                $column__validity_length
                    = $this->getDateTimeLength($column__validity_text);
                $column__end_sale_date
                    = trim(preg_replace("/\s{2,}/", " ", $node->filterXPath(self::COUPON_PARAMS["param__end_sale"])->text()));
                $column__end_sale_date
                    = $this->getEndSaleDate($column__end_sale_date);

                $db = $this->getDb();
                $connection = new \mysqli($db->getDbHost(), $db->getDbUser(), $db->getDbPass(), $db->getDbName());
                $query = "SELECT * FROM `".$db->getDbTable()."` WHERE `title` = '".$column__title."' AND `id` > 0";
                $result = $connection->query($query);
                $row = $result->fetch_assoc();
                $result->free_result();
                if ($row)
                {
                    $query =
                        "UPDATE `".$this->db->getDbTable()."` 
                        SET `end_sale_date` = '".$column__end_sale_date."' 
                        WHERE `title` = '".$column__title."'";
                    if ($connection->query($query) !== TRUE)
                        die($connection->error);
                } else {
                    $query =
                        "INSERT INTO `".$this->db->getDbTable()."` 
                        (`title`, `link`, `src_image`, `validity_text`, `validity_length`, `end_sale_date`)
                        VALUES (
                        '$column__title', 
                        '$column__link', 
                        '$column__src_image', 
                        '$column__validity_text', 
                        '$column__validity_length', 
                        '$column__end_sale_date'
                        )";
                    if ($connection->query($query) !== TRUE)
                        die($connection->error);
                }
            }
        });
        $count_coupons = $this->getCountCoupons($crawler);
        return $count_coupons;
    }

}