<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RequestTest extends DuskTestCase
{

    public function testCreateRequest()
    {
        $admin = \App\User::find(1);
        $request = factory('App\Request')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $request) {
            $browser->loginAs($admin)
                ->visit(route('admin.requests.index'))
                ->clickLink('Add new')
                ->type("landingpage", $request->landingpage)
                ->radio("target", $request->target)
                ->type("city", $request->city)
                ->type("not_clear", $request->not_clear)
                ->check("no_phonenumber")
                ->check("no_email")
                ->check("no_form")
                ->check("no_content")
                ->check("no_faq")
                ->select("adgroup_id", $request->adgroup_id)
                ->type("other_keywords", $request->other_keywords)
                ->type("aswered", $request->aswered)
                ->press('Save')
                ->assertRouteIs('admin.requests.index')
                ->assertSeeIn("tr:last-child td[field-key='landingpage']", $request->landingpage)
                ->assertSeeIn("tr:last-child td[field-key='target']", $request->target)
                ->assertSeeIn("tr:last-child td[field-key='city']", $request->city)
                ->assertSeeIn("tr:last-child td[field-key='not_clear']", $request->not_clear)
                ->assertChecked("no_phonenumber")
                ->assertChecked("no_email")
                ->assertChecked("no_form")
                ->assertChecked("no_content")
                ->assertChecked("no_faq")
                ->assertSeeIn("tr:last-child td[field-key='adgroup']", $request->adgroup->title)
                ->assertSeeIn("tr:last-child td[field-key='other_keywords']", $request->other_keywords)
                ->assertSeeIn("tr:last-child td[field-key='aswered']", $request->aswered)
                ->logout();
        });
    }

    public function testEditRequest()
    {
        $admin = \App\User::find(1);
        $request = factory('App\Request')->create();
        $request2 = factory('App\Request')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $request, $request2) {
            $browser->loginAs($admin)
                ->visit(route('admin.requests.index'))
                ->click('tr[data-entry-id="' . $request->id . '"] .btn-info')
                ->type("landingpage", $request2->landingpage)
                ->radio("target", $request2->target)
                ->type("city", $request2->city)
                ->type("not_clear", $request2->not_clear)
                ->check("no_phonenumber")
                ->check("no_email")
                ->check("no_form")
                ->check("no_content")
                ->check("no_faq")
                ->select("adgroup_id", $request2->adgroup_id)
                ->type("other_keywords", $request2->other_keywords)
                ->type("aswered", $request2->aswered)
                ->press('Update')
                ->assertRouteIs('admin.requests.index')
                ->assertSeeIn("tr:last-child td[field-key='landingpage']", $request2->landingpage)
                ->assertSeeIn("tr:last-child td[field-key='target']", $request2->target)
                ->assertSeeIn("tr:last-child td[field-key='city']", $request2->city)
                ->assertSeeIn("tr:last-child td[field-key='not_clear']", $request2->not_clear)
                ->assertChecked("no_phonenumber")
                ->assertChecked("no_email")
                ->assertChecked("no_form")
                ->assertChecked("no_content")
                ->assertChecked("no_faq")
                ->assertSeeIn("tr:last-child td[field-key='adgroup']", $request2->adgroup->title)
                ->assertSeeIn("tr:last-child td[field-key='other_keywords']", $request2->other_keywords)
                ->assertSeeIn("tr:last-child td[field-key='aswered']", $request2->aswered)
                ->logout();
        });
    }

    public function testShowRequest()
    {
        $admin = \App\User::find(1);
        $request = factory('App\Request')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $request) {
            $browser->loginAs($admin)
                ->visit(route('admin.requests.index'))
                ->click('tr[data-entry-id="' . $request->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='landingpage']", $request->landingpage)
                ->assertSeeIn("td[field-key='target']", $request->target)
                ->assertSeeIn("td[field-key='city']", $request->city)
                ->assertSeeIn("td[field-key='not_clear']", $request->not_clear)
                ->assertNotChecked("no_phonenumber")
                ->assertNotChecked("no_email")
                ->assertNotChecked("no_form")
                ->assertNotChecked("no_content")
                ->assertNotChecked("no_faq")
                ->assertSeeIn("td[field-key='adgroup']", $request->adgroup->title)
                ->assertSeeIn("td[field-key='other_keywords']", $request->other_keywords)
                ->assertSeeIn("td[field-key='aswered']", $request->aswered)
                ->assertSeeIn("td[field-key='created_by']", $request->created_by->name)
                ->logout();
        });
    }

}
