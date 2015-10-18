<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CubeControllerTest extends TestCase
{
    /**
     * A functional test for index.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->visit('/cube')
            ->see('Choose a Cube')
            ->see('Add a Cube')
            ->see('Upload Cube')
            ->see('This is an application just to show how the Cube Summation')
            ->dontSee('Update Cube')
            ->dontSee('Query Cube')
            ->dontSee('Blocks for');
    }

    /**
     * Two functional tests for storage.
     *
     * @return void
     */
    public function testStorage()
    {
        // Test with correct field name
        $this->visit('/cube')
            ->type('First Cube', 'name')
            ->press('submit-add')
            ->see('created successfully');

        // Test with incorrect field name
        $this->visit('/cube')
            ->press('submit-add')
            ->see('is required');
    }

    /**
     * A functional test for show.
     *
     * @return void
     */
    public function testShow()
    {
        $this->visit('/cube/1')
            ->see('Update Cube')
            ->see('Query Cube')
            ->see('Blocks for');
    }

    /**
     * Four functional tests for update.
     *
     * @return void
     */
    public function testUpdate()
    {
        // Test with correct field name
        $this->visit('/cube/1')
            ->type('3', 'x')
            ->type('3', 'y')
            ->type('3', 'z')
            ->type('1', 'value')
            ->press('submit-update')
            ->see('updated successfully');

        /*
        * Tests with incorrect fields
        */
        // Field required
        $this->visit('/cube/1')
            ->press('submit-update')
            ->see('is required');

        // Field must be integer
        $this->visit('/cube/1')
            ->type('1a', 'x')
            ->press('submit-update')
            ->see('integer');

        // Field value very great
        $this->visit('/cube/1')
            ->type('1000000000', 'y')
            ->press('submit-update')
            ->see('greater');
    }

    /**
     * Four functional tests for query.
     *
     * @return void
     */
    public function testQuery()
    {
        // Test with correct field name
        $this->visit('/cube/1')
            ->type('1', 'x1')
            ->type('1', 'y1')
            ->type('1', 'z1')
            ->type('2', 'x2')
            ->type('2', 'y2')
            ->type('2', 'z2')
            ->press('submit-query')
            ->see('the sum of: 27');

        /*
        * Tests with incorrect fields
        */
        // Field required
        $this->visit('/cube/1')
            ->press('submit-query')
            ->see('is required');

        // Field must be integer
        $this->visit('/cube/1')
            ->type('1a', 'z1')
            ->press('submit-query')
            ->see('integer');

        // Field value very great
        $this->visit('/cube/1')
            ->type('10000000', 'z2')
            ->press('submit-query')
            ->see('greater');
    }

}
