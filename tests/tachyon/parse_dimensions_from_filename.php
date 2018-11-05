<?php 

class Tests_Tachyon_ParseDimensionsFromFilename extends WP_UnitTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->class_instance = Tachyon::instance();
    }

    public function test_empty_result() {
        $src = '/images/image1.jpg';
        $dimensions = $this->class_instance::parse_dimensions_from_filename($src);
        $this->assertEquals( [false, false], $dimensions);
    }

    public function test_200x250() {
        $src = '/images/image1-200x250.jpg';
        $dimensions = $this->class_instance::parse_dimensions_from_filename($src);
        $this->assertEquals( [200, 250], $dimensions );
    }

    public function test_only_height() {
        $src = '/images/image1-x200.jpg';
        $dimensions = $this->class_instance::parse_dimensions_from_filename($src);
        $this->assertEquals( [false, false], $dimensions );
    }

    public function test_only_width() {
        $src = '/images/image1-200x.jpg';
        $dimensions = $this->class_instance::parse_dimensions_from_filename($src);
        $this->assertEquals( [false, false], $dimensions );
    }
}