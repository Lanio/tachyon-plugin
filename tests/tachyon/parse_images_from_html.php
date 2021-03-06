<?php 

class Tests_Tachyon_ParseImagesFromHTML extends WP_UnitTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->class_instance = Tachyon::instance();
        
        $this->content = '<html><body>';
        $this->content .= '<img src="/images/image1.jpg" />';
        $this->content .= '<a href="/images/image2.jpg"><img src="image2.jpg" /></a>';
        $this->content .= '</body></html>';
    }

    public function test_empty_result() {
        $this->parsed_images = $this->class_instance::parse_images_from_html( "" );
        $this->assertEquals([], $this->parsed_images);
    }

    public function test_full_match()
    {
        $this->parsed_images = $this->class_instance::parse_images_from_html( $this->content );

        $expected = array(
            '<img src="/images/image1.jpg" />',
            '<a href="/images/image2.jpg"><img src="image2.jpg" /></a>'
        );

        $this->assertEquals($expected, $this->parsed_images[0]);
    }

    public function test_parses_link_urls() {
        $this->parsed_images = $this->class_instance::parse_images_from_html( $this->content );

        $expected = array(
            "",
            "/images/image2.jpg"
        );
 
        $this->assertEquals($expected, $this->parsed_images['link_url']);      
    }

    public function test_parses_img_tags() {
        $this->parsed_images = $this->class_instance::parse_images_from_html( $this->content );

        $expected = array(
            '<img src="/images/image1.jpg" />',
            '<img src="image2.jpg" />'
        );

        $this->assertEquals($expected, $this->parsed_images['img_tag']);      
    }

    public function test_parses_img_url() {
        $this->parsed_images = $this->class_instance::parse_images_from_html( $this->content );

        $expected = array(
            '/images/image1.jpg',
            'image2.jpg'
        );

        $this->assertEquals($expected, $this->parsed_images['img_url']);
    }
}