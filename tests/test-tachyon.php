<?php 

class TachyonTest extends WP_UnitTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->class_instance = Tachyon::instance();
        
        $this->content = '<html><body>';
        $this->content .= '<img src="/images/image1.jpg" />';
        $this->content .= '<a href="/images/image2.jpg"><img src="image2.jpg" /></a>';
        $this->content .= '</body></html>';

        $this->parsed_images = $this->class_instance::parse_images_from_html( $this->content );
        // print_r($this->parsed_images);
    }

    public function test_parse_images_from_html_discovers_all_images()
    {
        $expected = array(
            '<img src="/images/image1.jpg" />',
            '<a href="/images/image2.jpg"><img src="image2.jpg" /></a>'
        );

        $this->assertEquals($expected, $this->parsed_images[0]);
    }

    public function test_parse_images_from_html_returns_link_urls() {

        $expected = array(
            "",
            "/images/image2.jpg"
        );
 
        $this->assertEquals($expected, $this->parsed_images['link_url']);      
    }

    public function test_parse_images_from_html_returns_img_tags() {
        $expected = array(
            '<img src="/images/image1.jpg" />',
            '<img src="image2.jpg" />'
        );

        $this->assertEquals($expected, $this->parsed_images['img_tag']);      
    }

    public function test_parse_images_from_html_returns_img_url() {
        $expected = array(
            '/images/image1.jpg',
            'image2.jpg'
        );

        $this->assertEquals($expected, $this->parsed_images['img_url']);
    }
}