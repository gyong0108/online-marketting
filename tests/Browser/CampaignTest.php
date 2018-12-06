<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CampaignTest extends DuskTestCase
{

    public function testCreateCampaign()
    {
        $admin = \App\User::find(1);
        $campaign = factory('App\Campaign')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $campaign) {
            $browser->loginAs($admin)
                ->visit(route('admin.campaigns.index'))
                ->clickLink('Add new')
                ->type("name", $campaign->name)
                ->type("keywords", $campaign->keywords)
                ->type("daily_budget", $campaign->daily_budget)
                ->type("title", $campaign->title)
                ->type("undertitle", $campaign->undertitle)
                ->type("shortdescription", $campaign->shortdescription)
                ->type("description", $campaign->description)
                ->attach("logo", base_path("tests/_resources/test.jpg"))
                ->attach("image", base_path("tests/_resources/test.jpg"))
                ->type("email", $campaign->email)
                ->uncheck("active")
                ->press('Save')
                ->assertRouteIs('admin.campaigns.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $campaign->name)
                ->assertSeeIn("tr:last-child td[field-key='daily_budget']", $campaign->daily_budget)
                ->assertSeeIn("tr:last-child td[field-key='title']", $campaign->title)
                ->assertSeeIn("tr:last-child td[field-key='undertitle']", $campaign->undertitle)
                ->assertNotChecked("active")
                ->logout();
        });
    }

    public function testEditCampaign()
    {
        $admin = \App\User::find(1);
        $campaign = factory('App\Campaign')->create();
        $campaign2 = factory('App\Campaign')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $campaign, $campaign2) {
            $browser->loginAs($admin)
                ->visit(route('admin.campaigns.index'))
                ->click('tr[data-entry-id="' . $campaign->id . '"] .btn-info')
                ->type("name", $campaign2->name)
                ->type("keywords", $campaign2->keywords)
                ->type("daily_budget", $campaign2->daily_budget)
                ->type("title", $campaign2->title)
                ->type("undertitle", $campaign2->undertitle)
                ->type("shortdescription", $campaign2->shortdescription)
                ->type("description", $campaign2->description)
                ->attach("logo", base_path("tests/_resources/test.jpg"))
                ->attach("image", base_path("tests/_resources/test.jpg"))
                ->type("email", $campaign2->email)
                ->uncheck("active")
                ->press('Update')
                ->assertRouteIs('admin.campaigns.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $campaign2->name)
                ->assertSeeIn("tr:last-child td[field-key='daily_budget']", $campaign2->daily_budget)
                ->assertSeeIn("tr:last-child td[field-key='title']", $campaign2->title)
                ->assertSeeIn("tr:last-child td[field-key='undertitle']", $campaign2->undertitle)
                ->assertNotChecked("active")
                ->logout();
        });
    }

    public function testShowCampaign()
    {
        $admin = \App\User::find(1);
        $campaign = factory('App\Campaign')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $campaign) {
            $browser->loginAs($admin)
                ->visit(route('admin.campaigns.index'))
                ->click('tr[data-entry-id="' . $campaign->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $campaign->name)
                ->assertSeeIn("td[field-key='keywords']", $campaign->keywords)
                ->assertSeeIn("td[field-key='daily_budget']", $campaign->daily_budget)
                ->assertSeeIn("td[field-key='title']", $campaign->title)
                ->assertSeeIn("td[field-key='undertitle']", $campaign->undertitle)
                ->assertSeeIn("td[field-key='shortdescription']", $campaign->shortdescription)
                ->assertSeeIn("td[field-key='description']", $campaign->description)
                ->assertSeeIn("td[field-key='email']", $campaign->email)
                ->assertChecked("active")
                ->logout();
        });
    }

}
