<?php 

class Tests_Tachyon_FilterTheContent extends WP_UnitTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->class_instance = Tachyon::instance();
        $this->content = fixture('index.fixture');
    }

    public function test_empty_result() {
        $content = "<html><body>";
        $content .= "</body></html>";

        $result = $this->class_instance::filter_the_content($content);
        $this->assertEquals($result, $content);
    }

    // public function test_should_filter_the_content() {
    //     $result = $this->class_instance::filter_the_content($this->content);
    //     print_r($result);
    //     $this->assertNotEquals($result, $this->content);
    // }

    public function test_should_skip_filtered_url() {
        add_filter( 'tachyon_skip_for_url', function ( $skip, $image_url, $args ) {
            if ( strpos( $image_url, 'image1.jpg' ) !== false ) {
                return true;
            }
            
            return $skip;
        }, 10, 3 );

        $result = $this->class_instance::filter_the_content($this->content);
        $this->assertEquals($result, $this->content);
    }

    # TODO
    # test_tachyon_skip_image
    # test_automattic lazy loading
    # ::validate_image_url
    # Detect custom-cropped thumbnail
    # ::strip_image_dimensions_maybe
    # ::image_sizes
    # filter_the_galleries
    # filter_image_downsize
    # filter_srcset_array   
}