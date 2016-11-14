@extends('layouts.master')

@section('content')

<h1>{{ $page->chapter->category->title }} - {{ $page->chapter->title }}</h1>
<h2>
    {{ $page->title }}
</h2>

<h4 class="m-t-xl m-b-lg">{{ $page->description }}</h4>

<hr>
<table class="table" border="0" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td colspan="6">
            <h2>maydenasvnode1: &nbsp;Generic Wordpress Host</h2>
            </td>
        </tr>
        <tr>
            <th><h3>Application</h3></th>
            <th><h3>URL</h3></th>
            <th><h3>App Server</h3></th>
            <th><h3>Db Server</h3></th>
            <th><h3>Status</h3></th>
            <th><h3>Int. IP:port</h3></th>
        </tr>
        <tr>
            <td>Mayden</td>
            <td><a href="http://www.mayden.co.uk/">http://www.mayden.co.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>IAPTus</td>
            <td><a href="http://www.iaptus.co.uk/">http://www.iaptus.co.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>bacpac</td>
            <td><a href="http://www.bac-pac.co.uk/" target="_blank">http://www.bac-pac.co.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>n/a</td>
            <td>Holding</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>bacpac help</td>
            <td><a href="http://help.bac-pac.co.uk/" target="_blank">http://help.bac-pac.co.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Pending</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>Apps</td>
            <td><a href="http://apps.mayden.co.uk/">http://apps.mayden.co.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>n/a</td>
            <td>APACHE</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>Pathways</td>
            <td><a href="http://pathways.mayden.co.uk/" target="_blank">http://pathways.mayden.co.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>Orbit</td>
            <td><a href="http://orbit.mayden.co.uk/" target="_blank">http://orbit.mayden.co.uk</a>/</td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>Clients</td>
            <td><a href="http://clients.mayden.co.uk/" target="_blank">http://clients.mayden.co.uk</a>/</td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>Assure</td>
            <td><a href="http://assure.mayden.co.uk/" target="_blank">http://assure.mayden.co.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>M3</td>
            <td><a href="http://m3.mayden.co.uk/" target="_blank">http://m3.mayden.co.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>Mayden Foundation</td>
            <td><a href="http://www.mayden.org.uk/" target="_blank">http://www.mayden.org.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>PT Resource Directory</td>
            <td><a href="http://www.newsavoydirectory.org/" target="_blank">http://www.newsavoydirectory.org/</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>AWP Lift</td>
            <td><a href="http://www.lift.awp.nhs.uk/" target="_blank">http://www.lift.awp.nhs.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>Healthy Curiosity</td>
            <td><a href="http://www.healthycuriosity.net/" target="_blank">http://www.healthycuriosity.net/</a></td>
            <td>maydenasvnode1</td>
            <td>n/a</td>
            <td>Holding</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>SELCRN</td>
            <td><a href="http://www.selcrn.nhs.uk/" target="_blank">http://www.selcrn.nhs.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>Future Climate</td>
            <td><a href="http://www.fc-es.net/" target="_blank">http://www.fc-es.net/</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>PCH Projects</td>
            <td><a href="http://www.pch-projects.co.uk/" target="_blank">http://www.pch-projects.co.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>NPRP</td>
            <td><a href="http://www.nationalpeerreview.nhs.uk/" target="_blank">http://www.nationalpeerreview.nhs.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>MyCancerTreament</td>
            <td><a href="http://www.mycancertreatment.nhs.uk/" target="_blank">http://www.mycancertreatment.nhs.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>SWEET-Project</td>
            <td><a href="http://sweet-project.mayden.co.uk/" target="_blank">http://sweet-project.mayden.co.uk/</a></td>
            <td>maydenasvnode1</td>
            <td>n/a</td>
            <td>Redirect</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>ELCQuA test</td>
            <td><a href="http://elcquatest.mayden.co.uk/" target="_blank">http://elcquatest.mayden.co.uk/</a></td>
            <td>???</td>
            <td>???</td>
            <td>Redirect</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>Business Against Poverty</td>
            <td><a href="http://www.businessagainstpoverty.com/">http://www.businessagainstpoverty.com</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>People Against Poverty</td>
            <td><a href="https://crm.mayden.co.uk/library/241/www.peopleagainstpoverty.co.uk">www.peopleagainstpoverty.co.uk</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>My Diabetes Service</td>
            <td><a href="https://crm.mayden.co.uk/library/241/www.mydiabetesservice.nhs.uk">www.mydiabetesservice.nhs.uk</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>My Action</td>
            <td><a href="https://crm.mayden.co.uk/library/241/www.myaction.org.uk">www.myaction.org.uk</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>Trauma</td>
            <td><a href="https://crm.mayden.co.uk/library/241/trauma.mayden.co.uk">trauma.mayden.co.uk</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td>Bromley Working for Wellbeing</td>
            <td><a href="http://www.bromleyworkingforwellbeing.org.uk/">www.bromleyworkingforwellbeing.org.uk</a></td>
            <td>maydenasvnode1</td>
            <td>maydenasvnode1</td>
            <td>Live</td>
            <td>192.168.60.1:80</td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
            <td>&nbh2p;</th2>
        </tr>
        <tr>
            <td colspan="6">
            <h2>maydenasvnode2: &nbsp;Staging Host</h2>
            </td>
        </tr>
        <tr>
            <th><h3>Application</h3></th>
            <th><h3>URL</h3></th>
            <th><h3>App Server</h3></th>
            <th><h3>Db Server</h3></th>
            <th><h3>Status</h3></th>
            <th><h3>Int. IP:port</h3></th>
        </tr>
        <tr>
            <td>Staging Server</td>
            <td><a href="http://%2A.maydendev.co.uk/" target="_blank">http://*.maydendev.co.uk/</a></td>
            <td>maydenasvnode2</td>
            <td>maydenasvnode2</td>
            <td>Live</td>
            <td>192.168.60.2:80</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6">
            <h2>maydenasvnode3: &nbsp;Legacy Sites Host</h2>
            </td>
        </tr>
        <tr>
            <th><h3>Application</h3></th>
            <th><h3>URL</h3></th>
            <th><h3>App Server</h3></th>
            <th><h3>Db Server</h3></th>
            <th><h3>Status</h3></th>
            <th><h3>Int. IP:port</h3></th>
        </tr>
        <tr>
            <td>QARC</td>
            <td><a href="http://www.londonqarc.nhs.uk/" target="_blank">http://www.londonqarc.nhs.uk/</a></td>
            <td>maydenasvnode3</td>
            <td>maydenasvnode3</td>
            <td>Live</td>
            <td>192.168.60.3:80</td>
        </tr>
        <tr>
            <td>SLAM-IAPT</td>
            <td><a href="http://www.slam-iapt.nhs.uk/" target="_blank">http://www.slam-iapt.nhs.uk/</a></td>
            <td>maydenasvnode3</td>
            <td>maydenasvnode3</td>
            <td>Live</td>
            <td>192.168.60.3:80</td>
        </tr>
        <tr>
            <td>Corsham Postcards</td>
            <td><a href="http://www.corshampostcards.com/" target="_blank">http://www.corshampostcards.com/</a></td>
            <td>maydenasvnode3</td>
            <td>maydenasvnode3</td>
            <td>Live</td>
            <td>192.168.60.3:80</td>
        </tr>
        <tr>
            <td>Pots of Colour</td>
            <td><a href="http://www.pots-of-colour.co.uk/" target="_blank">http://www.pots-of-colour.co.uk/</a></td>
            <td>maydenasvnode3</td>
            <td>maydenasvnode3</td>
            <td>Live</td>
            <td>192.168.60.3:80</td>
        </tr>
        <tr>
            <td>Silent Light</td>
            <td><a href="http://www.silentlight.co.uk/" target="_blank">http://www.silentlight.co.uk/</a></td>
            <td>maydenasvnode3</td>
            <td>maydenasvnode3</td>
            <td>Live</td>
            <td>192.168.60.3:80</td>
        </tr>
        <tr>
            <td>James Paget</td>
            <td><a href="http://www.jpaget.nhs.uk/" target="_blank">http://www.jpaget.nhs.uk/</a></td>
            <td>maydenasvnode3</td>
            <td>maydenasvnode3</td>
            <td>Live</td>
            <td>192.168.60.3:80</td>
        </tr>
        <tr>
            <td>My Physics Choice</td>
            <td><a href="http://www.myphysicscourse.org/" target="_blank">http://www.myphysicscourse.org/</a></td>
            <td>maydenasvnode3</td>
            <td>maydenasvnode3</td>
            <td>Live</td>
            <td>192.168.60.3:80</td>
        </tr>
        <tr>
            <td>Bible Reflections</td>
            <td><a href="http://www.bible-reflections.net/" target="_blank">http://www.bible-reflections.net/</a></td>
            <td>maydenasvnode3</td>
            <td>maydenasvnode3</td>
            <td>Live</td>
            <td>192.168.60.3:80</td>
        </tr>
        <tr>
            <td>CQuINS v3</td>
            <td><a href="http://www.v3.cquins.nhs.uk/" target="_blank">http://www.v3.cquins.nhs.uk/</a></td>
            <td>maydenasvnode3</td>
            <td>n/a</td>
            <td>Holding</td>
            <td>192.168.60.3:80</td>
        </tr>
        <tr>
            <td>London QARC</td>
            <td><a href="http://www.londonqarc.nhs.uk/" target="_blank">http://www.londonqarc.nhs.uk/</a></td>
            <td>maydenasvnode3</td>
            <td>n/a</td>
            <td>Disabled</td>
            <td>192.168.60.3:80</td>
        </tr>
        <tr>
            <td>hc2d UK</td>
            <td><a href="http://www.healthcare-today.co.uk/" target="_blank">http://www.healthcare-today.co.uk/</a></td>
            <td>maydenasvnode4</td>
            <td>maydenasvnode4</td>
            <td>Live</td>
            <td>192.168.60.4:80</td>
        </tr>
        <tr>
            <td>hc2d UK</td>
            <td><a href="http://www.hc2d.co.uk/" target="_blank">http://www.hc2d.co.uk/</a></td>
            <td>maydenasvnode4</td>
            <td>n/a</td>
            <td>Redirect</td>
            <td>192.168.60.4:80</td>
        </tr>
        <tr>
            <td>hc2d Global</td>
            <td><a href="http://www.hc2d.net/" target="_blank">http://www.hc2d.net/</a></td>
            <td>maydenasvnode4</td>
            <td>n/a</td>
            <td>Redirect</td>
            <td>192.168.60.4:80</td>
        </tr>
        <tr>
            <td>hc2d US</td>
            <td><a href="http://www.hc2d.net/" target="_blank">http://www.hc2d.com/</a></td>
            <td>maydenasvnode4</td>
            <td>n/a</td>
            <td>Redirect</td>
            <td>192.168.60.4:80</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6">
            <h2>maydenasvnode4: &nbsp;HC2D Host</h2>
            </td>
        </tr>
        <tr>
            <th><h3>Application</h3></th>
            <th><h3>URL</h3></th>
            <th><h3>App Server</h3></th>
            <th><h3>Db Server</h3></th>
            <th><h3>Status</h3></th>
            <th><h3>Int. IP:port</h3></th>
        </tr>
        <tr>
            <td>hc2d UK</td>
            <td><a href="http://www.healthcare-today.co.uk/" target="_blank">http://www.healthcare-today.co.uk/</a></td>
            <td>maydenasvnode4</td>
            <td>maydenasvnode4</td>
            <td>Disabled</td>
            <td>192.168.60.4:80</td>
        </tr>
        <tr>
            <td>hc2d UK</td>
            <td><a href="http://www.hc2d.co.uk/" target="_blank">http://www.hc2d.co.uk/</a></td>
            <td>maydenasvnode4</td>
            <td>n/a</td>
            <td>Disabled</td>
            <td>192.168.60.4:80</td>
        </tr>
        <tr>
            <td>hc2d Global</td>
            <td><a href="http://www.hc2d.net/" target="_blank">http://www.hc2d.net/</a></td>
            <td>maydenasvnode4</td>
            <td>n/a</td>
            <td>Disabled</td>
            <td>192.168.60.4:80</td>
        </tr>
        <tr>
            <td>hc2d US</td>
            <td><a href="http://www.hc2d.net/" target="_blank">http://www.hc2d.com/</a></td>
            <td>maydenasvnode4</td>
            <td>n/a</td>
            <td>Disabled</td>
            <td>192.168.60.4:80</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6">
            <h2>maydenasvnode5: &nbsp;ORBIT (&amp; Private Sites Host)</h2>
            </td>
        </tr>
        <tr>
            <th><h3>Application</h3></th>
            <th><h3>URL</h3></th>
            <th><h3>App Server</h3></th>
            <th><h3>Db Name</h3></th>
            <th><h3>Status</h3></th>
            <th><h3>Int. IP:port</h3></th>
        </tr>
        <tr>
            <td>Mayden Intranet</td>
            <td><a href="https://crm.mayden.co.uk/" target="_blank">https://crm.mayden.co.uk</a></td>
            <td>maydenasvnode5</td>
            <td>crm</td>
            <td>Live</td>
            <td>192.168.60.5:443</td>
        </tr>
        <tr>
            <td>Mayden Support</td>
            <td><a href="http://support.mayden.co.uk/" target="_blank">http://support.mayden.co.uk</a></td>
            <td>maydenasvnode5</td>
            <td>maydenasvnode5</td>
            <td>Live</td>
            <td>192.168.60.5:80</td>
        </tr>
        <tr>
            <td>QUACS</td>
            <td><a href="https://www.london.quacs.nhs.uk/" target="_blank">https://www.london.quacs.nhs.uk/</a></td>
            <td>maydenasvnode5</td>
            <td>maydenasvnode5</td>
            <td>Live</td>
            <td>192.168.60.5:443</td>
        </tr>
        <tr>
            <td>???QUACS</td>
            <td><a href="http://www.myprogress.info/" target="_blank">http://www.myprogress.info/</a></td>
            <td>maydenasvnode5</td>
            <td>n/a</td>
            <td>Holding</td>
            <td>192.168.60.5:80</td>
        </tr>
        <tr>
            <td>ELCQUA</td>
            <td><a href="http://www.elcqua.nhs.uk/" target="_blank">http://www.elcqua.nhs.uk/</a></td>
            <td>maydenasvnode5</td>
            <td>maydenasvnode5</td>
            <td>Live</td>
            <td>192.168.60.5:80</td>
        </tr>
        <tr>
            <td>ELCQuA test</td>
            <td><a href="https://elcquatest.mayden.co.uk/" target="_blank">https://elcquatest.mayden.co.uk/</a></td>
            <td>maydenasvnode5</td>
            <td>n/a</td>
            <td>Redirect</td>
            <td>192.168.60.5:443</td>
        </tr>
        <tr>
            <td>Sci-Teq Orbit</td>
            <td><a href="https://orbit.sci-teq.co.uk/" target="_blank">https://orbit.sci-teq.co.uk/</a></td>
            <td>maydenasvnode5</td>
            <td>sciteq</td>
            <td>Live</td>
            <td>192.168.60.5:443</td>
        </tr>
        <tr>
            <td>Sci-Teq Orbit Support</td>
            <td><a href="http://support.sci-teq.co.uk/" target="_blank">http://support.sci-teq.co.uk</a></td>
            <td>maydenasvnode5</td>
            <td>maydenasvnode5</td>
            <td>Live</td>
            <td>192.168.60.5:80</td>
        </tr>
        <tr>
            <td>Sci-Teq Support</td>
            <td><a href="http://support.parseq.com/" target="_blank">http://support.parseq.com</a></td>
            <td>maydenasvnode5</td>
            <td>maydenasvnode5</td>
            <td>Live</td>
            <td>192.168.60.5:80</td>
        </tr>
        <tr>
            <td>CLCBS Orbit</td>
            <td><a href="http://clcbs.orbit.mayden.co.uk/" target="_blank">http://clcbs.orbit.mayden.co.uk/</a></td>
            <td>maydenasvnode5</td>
            <td>orbit_lancs</td>
            <td>Live</td>
            <td>192.168.60.5:80</td>
        </tr>
        <tr>
            <td>WEASHN Orbit</td>
            <td><a href="http://weahsn-orbit.mayden.co.uk/" target="_blank">http://weahsn-orbit.mayden.co.uk/</a></td>
            <td>maydenasvnode5</td>
            <td>orbit_weashn</td>
            <td>Live</td>
            <td>192.168.60.5:80</td>
        </tr>
        <tr>
            <td>ICHP Orbit</td>
            <td><a href="http://ichp-orbit.mayden.co.uk/" target="_blank">http://ichp-orbit.mayden.co.uk/</a></td>
            <td>maydenasvnode5</td>
            <td>orbit_ichp</td>
            <td>Live</td>
            <td>192.168.60.5:80</td>
        </tr>
        <tr>
            <td>NELCSU Orbit</td>
            <td><a href="http://nelcsu-orbit.mayden.co.uk/" target="_blank">http://nelcsu-orbit.mayden.co.uk/</a></td>
            <td>maydenasvnode5</td>
            <td>orbit_nelcsu</td>
            <td>Pending</td>
            <td>192.168.60.5:80</td>
        </tr>
        <tr>
            <td>M3 Orbit</td>
            <td><a href="http://m3support.mayden.co.uk/" target="_blank">http://m3support.mayden.co.uk</a></td>
            <td>maydenasvnode5</td>
            <td>orbit_nelcsu</td>
            <td>Pending</td>
            <td>192.168.60.5:80</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
            <p>&nbsp;</p>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6">
            <h2>maydencqvnode12:&nbsp;CQuINS</h2>
            </td>
        </tr>
        <tr>
            <th><h3>Application</h3></th>
            <th><h3>URL</h3></th>
            <th><h3>App Server</h3></th>
            <th><h3>Db Server</h3></th>
            <th><h3>Status</h3></th>
            <th><h3>Int. IP:port</h3></th>
        </tr>
        <tr>
            <td>CQuINS</td>
            <td><a href="http://www.cquins.nhs.uk/" target="_blank">http://www.cquins.nhs.uk/</a></td>
            <td>maydencqvnode12</td>
            <td>maydencqvnode12</td>
            <td>Live</td>
            <td>192.168.70.1:80</td>
        </tr>
        <tr>
            <td>DQuINS</td>
            <td><a href="http://www.dquins.nhs.uk/" target="_blank">http://www.dquins.nhs.uk/</a></td>
            <td>maydencqvnode12</td>
            <td>maydencqvnode12</td>
            <td>Live</td>
            <td>192.168.70.1:80</td>
        </tr>
        <tr>
            <td>SQuINS</td>
            <td><a href="http://www.squins.nhs.uk/" target="_blank">http://www.squins.nhs.uk/</a></td>
            <td>maydencqvnode12</td>
            <td>maydencqvnode12</td>
            <td>Live</td>
            <td>192.168.70.1:80</td>
        </tr>
        <tr>
            <td>SWEET-Project</td>
            <td><a href="http://sweet-project.mayden.co.uk/" target="_blank">http://sweet-project.mayden.co.uk/</a></td>
            <td>maydencqvnode12</td>
            <td>maydencqvnode12</td>
            <td>Live</td>
            <td>192.168.70.1:80</td>
        </tr>
        <tr>
            <td>SWEET-Project</td>
            <td><a href="http://sweet-project.nationalpeerreview.nhs.uk/" target="_blank">http://sweet-project.nationalpeerreview.nhs.uk/</a></td>
            <td>maydencqvnode12</td>
            <td>maydencqvnode12</td>
            <td>Live</td>
            <td>192.168.70.1:80</td>
        </tr>
        <tr>
            <td>Trauma</td>
            <td><a href="http://trauma.nationalpeerreview.nhs.uk/" target="_blank">http://trauma.nationalpeerreview.nhs.uk/</a></td>
            <td>maydencqvnode12</td>
            <td>maydencqvnode12</td>
            <td>Pending</td>
            <td>192.168.70.1:80</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6">
            <h2>maydenbpvnode14: &nbsp;Bac-Pac Signup Host</h2>
            </td>
        </tr>
        <tr>
            <th><h3>Application</h3></th>
            <th><h3>URL</h3></th>
            <th><h3>App Server</h3></th>
            <th><h3>Db Server</h3></th>
            <th><h3>Status</h3></th>
            <th><h3>Int. IP:port</h3></th>
        </tr>
        <tr>
            <td>bacpac</td>
            <td><a href="http://www.bac-pac.co.uk/" target="_blank">http://www.bac-pac.co.uk/</a></td>
            <td>maydenbpvnode14</td>
            <td>n/a</td>
            <td>Redirect</td>
            <td>192.168.82.14:80</td>
        </tr>
        <tr>
            <td>bacpac</td>
            <td><a href="https://signup.bac-pac.co.uk/" target="_blank">https://signup.bac-pac.co.uk/</a></td>
            <td>maydenbpvnode14</td>
            <td>maydenbpvnode14</td>
            <td>Live</td>
            <td>192.168.82.14:443</td>
        </tr>
        <tr>
            <td>bacpac</td>
            <td><a href="https://devsignup.bac-pac.co.uk/" target="_blank">https://devsignup.bac-pac.co.uk/</a></td>
            <td>maydenbpvnode14</td>
            <td>maydenbpvnode14</td>
            <td>Live</td>
            <td>192.168.82.14:443</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6">
            <h2>maydenbpvnode15: &nbsp;Bac-Pac Secure Host</h2>
            </td>
        </tr>
        <tr>
            <th><h3>Application</h3></th>
            <th><h3>URL</h3></th>
            <th><h3>App Server</h3></th>
            <th><h3>Db Server</h3></th>
            <th><h3>Status</h3></th>
            <th><h3>Int. IP:port</h3></th>
        </tr>
        <tr>
            <td>bacpac</td>
            <td><a href="https://app.bac-pac.co.uk/" target="_blank">https://app.bac-pac.co.uk/</a></td>
            <td>maydenbpvnode15</td>
            <td>maydenbpvnode15</td>
            <td>Live</td>
            <td>192.168.83.15:443</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>ELCQuA</td>
            <td><a href="http://www.elcqua.nhs.uk/" target="_blank">http://www.elcqua.nhs.uk/</a></td>
            <td>maydenbpvnode18</td>
            <td>maydenbpvnode18</td>
            <td>Live</td>
            <td>[ext]31.25.9.78:80</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>myAction</td>
            <td><a href="http://www.myaction.org.uk/">http://www.myaction.org.uk/</a></td>
            <td>???</td>
            <td>???</td>
            <td>???</td>
            <td>x</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>bestCourse4me</td>
            <td><a href="http://www.bestcourse4me.com/">http://www.bestcourse4me.com/</a></td>
            <td>ACS</td>
            <td>ACS</td>
            <td>Live</td>
            <td>x</td>
        </tr>
        <tr>
            <td>myOxbridgeChoice</td>
            <td><a href="http://www.myoxbridgechoice.com/">http://www.myoxbridgechoice.com/</a></td>
            <td>ACS</td>
            <td>ACS</td>
            <td>Live</td>
            <td>x</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>CRiSCRoS</td>
            <td><a href="http://www.criscros.nhs.uk/">http://www.criscros.nhs.uk/</a></td>
            <td>105</td>
            <td>106</td>
            <td>Gone</td>
            <td>x</td>
        </tr>
        <tr>
            <td>happi</td>
            <td><a href="http://www.happi.org.uk/">http://www.happi.org.uk/</a></td>
            <td>105</td>
            <td>106</td>
            <td>Gone</td>
            <td>x</td>
        </tr>
        <tr>
            <td>WestWiltsCoaching</td>
            <td><a href="http://www.westwiltscoaching.co.uk/">http://www.westwiltscoaching.co.uk/</a></td>
            <td>105</td>
            <td>106</td>
            <td>Gone</td>
            <td>x</td>
        </tr>
        <tr>
            <td>Island Bathrooms</td>
            <td><a href="http://islandbathrooms.co.uk/">http://islandbathrooms.co.uk/</a></td>
            <td>105</td>
            <td>106</td>
            <td>Gone</td>
            <td>x</td>
        </tr>
        <tr>
            <td>NLCN</td>
            <td><a href="http://www.nlcn.nhs.uk/">http://www.nlcn.nhs.uk/</a></td>
            <td>105</td>
            <td>106</td>
            <td>Gone</td>
            <td>x</td>
        </tr>
        <tr>
            <td>Primetreatment</td>
            <td><a href="http://www.primetreatment.co.uk/">http://www.primetreatment.co.uk/</a></td>
            <td>105</td>
            <td>106</td>
            <td>Gone</td>
            <td>x</td>
        </tr>
    </tbody>
</table>

<div class="m-t-lg green-text">
    <small>Written by <h3><a href="/u/{{ $page->creator->slug }}">{{ $page->creator->name }}</a></h3>
</div>


@stop
