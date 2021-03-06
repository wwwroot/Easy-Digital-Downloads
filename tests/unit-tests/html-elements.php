<?php
namespace EDD_Unit_Tests;

/**
 * @group edd_html
 */
class Test_HTML_Elements extends EDD_UnitTestCase {
	protected $_post_id = null;

	public function setUp() {
		parent::setUp();

		$post_id = $this->factory->post->create( array( 'post_title' => 'Test Download', 'post_type' => 'download', 'post_status' => 'publish' ) );
		$this->_post_id = $post_id;
	}

	public function test_product_dropdown() {
		$expected = '<select name="products" id="products" class="edd-select "><option value="'. $this->_post_id .'">Test Download</option></select>';
		$this->assertEquals( $expected, EDD()->html->product_dropdown() );
	}

	public function test_discount_dropdown() {
		$meta = array(
			'name' => '50 Percent Off',
			'type' => 'percent',
			'amount' => '50',
			'code' => '50PERCENTOFF',
			'product_condition' => 'all'
		);

		edd_store_discount( $meta );

		$expected = '<select name="edd_discounts" id="" class="edd-select "><option value="'. edd_get_discount_id_by_code( '50PERCENTOFF' ) .'">50 Percent Off</option></select>';
		$this->assertEquals( $expected, EDD()->html->discount_dropdown() );
	}

	public function test_category_dropdown() {
		$expected = '<select name="edd_categories" id="" class="edd-select "></select>';
		$this->assertEquals( $expected, EDD()->html->category_dropdown() );
	}

	public function test_year_dropdown() {
		$expected = '<select name="year" id="" class="edd-select "><option value="2009">2009</option><option value="2010">2010</option><option value="2011">2011</option><option value="2012">2012</option><option value="2013">2013</option><option value="2014" selected=\'selected\'>2014</option></select>';
		$this->assertEquals( $expected, EDD()->html->year_dropdown() );
	}

	public function test_month_dropdown() {
		$out = EDD()->html->month_dropdown();
		$this->assertContains( '<select name="month" id="" class="edd-select ">', $out );
		$this->assertContains( '<option value="1">', $out );
		$this->assertContains( '<option value="2">', $out );
		$this->assertContains( '<option value="3">', $out );
		$this->assertContains( '<option value="4">', $out );
		$this->assertContains( '<option value="5">', $out );
		$this->assertContains( '<option value="6">', $out );
		$this->assertContains( '<option value="7">', $out );
		$this->assertContains( '<option value="8">', $out );
		$this->assertContains( '<option value="9">', $out );
		$this->assertContains( '<option value="10">', $out );
		$this->assertContains( '<option value="11">', $out );
		$this->assertContains( '<option value="12">', $out );
	}
}
