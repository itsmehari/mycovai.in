<?php
/**
 * HTML body for Tamil Nadu cabinet portfolios article (Coimbatore / Covai).
 * Uses HTML entities only for dashes and quotes (&mdash;, &rsquo;, etc.).
 */
declare(strict_types=1);

function covai_cabinet_article_build_mla_table(string $electionsBase, string $lang = 'en'): string
{
    $constituencies = require dirname(__DIR__, 2) . '/coimbatore-elections-2026/includes/constituency-data.php';
    $linkLabel = ($lang === 'ta') ? 'தொகுதி பக்கம்' : 'Constituency page';
    $rows = '';
    foreach ($constituencies as $slug => $ac) {
        $name = htmlspecialchars($ac['name'], ENT_QUOTES, 'UTF-8');
        $acNo = (int) $ac['ac_no'];
        $mla = htmlspecialchars($ac['winner_2026'] ?? '&mdash;', ENT_QUOTES, 'UTF-8');
        $party = htmlspecialchars($ac['winner_party_2026'] ?? '&mdash;', ENT_QUOTES, 'UTF-8');
        $link = htmlspecialchars($electionsBase . '/constituency/' . $slug . '.php', ENT_QUOTES, 'UTF-8');
        $rows .= "<tr><td>{$name}</td><td>{$acNo}</td><td>{$mla}</td><td>{$party}</td><td><a href=\"{$link}\">{$linkLabel}</a></td></tr>\n";
    }
    return $rows;
}

function covai_cabinet_article_html(string $electionsBase = '/coimbatore-elections-2026'): string
{
    $mlaRows = covai_cabinet_article_build_mla_table($electionsBase);
    $resultsUrl = htmlspecialchars($electionsBase . '/results-2026.php', ENT_QUOTES, 'UTF-8');
    $myomrSister = 'https://myomr.in/local-news/tamil-nadu-cabinet-portfolios-announced-chennai-omr-impact';

    return <<<HTML
<style>
.covai-cabinet-feature{font-family:Poppins,system-ui,sans-serif;color:#1a1a1a;line-height:1.65;max-width:920px;margin:0 auto}
.covai-cabinet-feature h2,.covai-cabinet-feature h3{font-family:Poppins,sans-serif!important;font-weight:700!important;margin-top:1.75rem;margin-bottom:.75rem}
.covai-cabinet-feature .ccb-eyebrow{font-size:.85rem;text-transform:uppercase;letter-spacing:.06em;color:#8B3D24;font-weight:600;margin-bottom:.5rem}
.covai-cabinet-feature .ccb-lead{font-size:1.15rem;color:#333;margin:1rem 0 1.5rem}
.covai-cabinet-feature .ccb-source-box{background:#fdf6f2;border:1px solid #e8d4c8;border-radius:10px;padding:1rem 1.25rem;margin:1.5rem 0}
.covai-cabinet-feature .ccb-source-box a{color:#B8522E;font-weight:600}
.covai-cabinet-feature .ccb-table-wrap{overflow-x:auto;margin:1.25rem 0 2rem;-webkit-overflow-scrolling:touch}
.covai-cabinet-feature table.ccb-cabinet-table{width:100%;border-collapse:collapse;font-size:.92rem;min-width:640px}
.covai-cabinet-feature table.ccb-cabinet-table th,.covai-cabinet-feature table.ccb-cabinet-table td{border:1px solid #e5e5e5;padding:.55rem .65rem;text-align:left;vertical-align:top}
.covai-cabinet-feature table.ccb-cabinet-table th{background:#B8522E;color:#fff;font-weight:600}
.covai-cabinet-feature table.ccb-cabinet-table tr.ccb-cm-row{background:#fff8f4}
.covai-cabinet-feature table.ccb-cabinet-table a{color:#8B3D24}
.covai-cabinet-feature .ccb-chips{display:flex;flex-wrap:wrap;gap:.5rem;margin:1rem 0 1.5rem}
.covai-cabinet-feature .ccb-chip{display:inline-block;background:#f5ebe6;color:#5c3d2e;padding:.35rem .75rem;border-radius:999px;font-size:.8rem;font-weight:600;text-decoration:none}
.covai-cabinet-feature .ccb-chip:hover{background:#B8522E;color:#fff}
.covai-cabinet-feature .ccb-pills{display:flex;flex-wrap:wrap;gap:.4rem;margin:1rem 0}
.covai-cabinet-feature .ccb-pill{background:#eee;font-size:.75rem;padding:.25rem .6rem;border-radius:4px}
.covai-cabinet-feature .ccb-cards{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin:1.5rem 0}
@media(max-width:640px){.covai-cabinet-feature .ccb-cards{grid-template-columns:1fr}}
.covai-cabinet-feature .ccb-card{border:1px solid #e8e8e8;border-radius:12px;padding:1.1rem 1.2rem;background:#fff}
.covai-cabinet-feature .ccb-card h3{font-size:1.05rem!important;margin-top:0!important}
.covai-cabinet-feature .ccb-tag{display:inline-block;font-size:.7rem;text-transform:uppercase;letter-spacing:.04em;background:#B8522E;color:#fff;padding:.2rem .5rem;border-radius:4px;margin-bottom:.5rem}
.covai-cabinet-feature .ccb-angle{margin-top:.85rem;padding:.75rem;background:#fdf6f2;border-left:4px solid #B8522E;font-size:.9rem}
.covai-cabinet-feature .ccb-angle strong{display:block;margin-bottom:.25rem;color:#8B3D24}
.covai-cabinet-feature .ccb-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin:1.5rem 0}
@media(max-width:768px){.covai-cabinet-feature .ccb-grid{grid-template-columns:1fr 1fr}}
@media(max-width:480px){.covai-cabinet-feature .ccb-grid{grid-template-columns:1fr}}
.covai-cabinet-feature .ccb-grid-item{background:#fafafa;border-radius:8px;padding:1rem;border:1px solid #eee}
.covai-cabinet-feature .ccb-grid-item h4{margin:0 0 .35rem;font-size:.95rem!important}
.covai-cabinet-feature ul.ccb-checklist{padding-left:1.25rem}
.covai-cabinet-feature ul.ccb-checklist li{margin-bottom:.4rem}
.covai-cabinet-feature .ccb-view{background:#1a1a1a;color:#f5f5f5;padding:1.25rem;border-radius:10px;margin:1.5rem 0}
.covai-cabinet-feature .ccb-view h2{color:#fff!important;margin-top:0!important}
.covai-cabinet-feature .ccb-sister{font-size:.9rem;color:#666;margin:1rem 0;padding:.75rem;background:#f9f9f9;border-radius:8px}
.covai-cabinet-feature .ccb-hero-img{width:100%;max-height:420px;object-fit:cover;border-radius:10px;margin:1rem 0}
.covai-cabinet-feature .ccb-disclaimer{font-size:.85rem;color:#666;font-style:italic}
.covai-cabinet-feature .ccb-mla-note{font-size:.9rem;margin-top:.75rem}
</style>

<div class="covai-cabinet-feature">

<p class="ccb-eyebrow">Coimbatore &amp; Covai &middot; State governance &middot; 16 May 2026</p>

<p class="ccb-lead">Portfolio allocations mark the formal start of department-level governance under Chief Minister C. Joseph Vijay, with direct implications for municipal services, industry, roads and healthcare across Coimbatore city and the wider district.</p>

<p>Tamil Nadu&rsquo;s new Council of Ministers has received its portfolio allocations, defining who runs water supply, highways, industries, schools, hospitals, power and the state budget for residents in RS Puram, Gandhipuram, Peelamedu, Singanallur, Saravanampatti, Kalapatti and peri-urban belts around Covai.</p>

<p><strong>Coimbatore, 16 May 2026</strong> &mdash; According to Lok Bhavan Press Release No. 38 dated 16.05.2026, the Chief Minister recommended portfolio allocations to the Governor; the Governor approved the distribution. News reports confirmed Vijay has retained Home, Police and Public Administration.</p>

<div class="ccb-source-box">
<p><strong>Official source:</strong> Lok Bhavan Press Release No. 38 (16 May 2026). Download the PDF for the complete ministerial list.</p>
<p><a href="https://mychennaicity.in/documents/tamil-nadu-cabinet-portfolios-may-2026/lok-bhavan-press-release-no-38-16-05-2026.pdf" target="_blank" rel="noopener">Download press release (PDF)</a></p>
</div>

<div class="ccb-sister">Chennai and OMR readership: see our sister article on <a href="{$myomrSister}" rel="noopener">MyOMR &mdash; Tamil Nadu cabinet portfolios for Chennai and OMR</a>.</div>

<img class="ccb-hero-img" src="https://images.news9live.com/wp-content/uploads/2025/06/Tamil-Nadu-govt.jpg" alt="Tamil Nadu Secretariat" width="1200" height="630" loading="lazy">

<h2 id="ccb-full-list">Full Cabinet Portfolio List</h2>
<p><em>At a glance</em></p>

<div class="ccb-table-wrap">
<table class="ccb-cabinet-table" aria-label="Tamil Nadu Council of Ministers and portfolios, May 2026">
<thead><tr><th>Minister</th><th>Designation</th><th>Major Portfolios</th></tr></thead>
<tbody>
<tr class="ccb-cm-row"><td><a href="#ccb-cm">C. Joseph Vijay</a></td><td>Chief Minister</td><td>Home, Police, Public, General Administration, Municipal Administration, Urban and Water Supply, Welfare Departments</td></tr>
<tr><td><a href="#ccb-anand">N. Anand</a></td><td>Minister for Rural Development and Water Resources</td><td>Rural Development, Panchayats, Poverty Alleviation, Irrigation</td></tr>
<tr><td><a href="#ccb-aadhav">Aadhav Arjuna</a></td><td>Minister for Public Works and Sports Development</td><td>Public Works, Buildings, Highways, Minor Ports, Sports Development</td></tr>
<tr><td><a href="#ccb-arunraj">Dr. K.G. Arunraj</a></td><td>Minister for Health, Medical Education and Family Welfare</td><td>Health, Medical Education, Family Welfare</td></tr>
<tr><td><a href="#ccb-finance">K.A. Sengottaiyan</a></td><td>Minister for Finance</td><td>Finance, Pensions, Pension Allowances</td></tr>
<tr><td><a href="#ccb-food">P. Venkataramanan</a></td><td>Minister for Food and Civil Supplies</td><td>Food, Civil Supplies, Consumer Protection, Price Control</td></tr>
<tr><td><a href="#ccb-energy">R. Nirmalkumar</a></td><td>Minister for Energy Resources and Law</td><td>Electricity, Renewable Energy, Law, Courts, Prisons, Anti-Corruption</td></tr>
<tr><td><a href="#ccb-school">Rajmohan</a></td><td>Minister for School Education, Tamil Development, Information and Publicity</td><td>School Education, Tamil Culture, Information and Publicity, Government Press</td></tr>
<tr><td><a href="#ccb-mines">Dr. TK. Prabhu</a></td><td>Minister for Natural Resources</td><td>Minerals and Mines</td></tr>
<tr><td><a href="#ccb-industries">Selvi S. Keerthana</a></td><td>Minister for Industries</td><td>Industries, Investment Promotion</td></tr>
</tbody>
</table>
</div>

<p>Tap a minister name to jump to their profile below.</p>

<p>For residents in Peelamedu, Singanallur, Saravanampatti, Kalapatti, Kuniyamuthur, Town Hall, Race Course, Ukkadam, Saibaba Colony, Thudiyalur, Vadavalli and the textile&ndash;foundry belt, these portfolios directly influence roads, water, urban administration, industries, education, health and power.</p>

<nav class="ccb-chips" aria-label="Jump to minister">
<a class="ccb-chip" href="#ccb-cm">CM</a>
<a class="ccb-chip" href="#ccb-aadhav">PWD</a>
<a class="ccb-chip" href="#ccb-finance">Finance</a>
<a class="ccb-chip" href="#ccb-industries">Industries</a>
<a class="ccb-chip" href="#ccb-arunraj">Health</a>
<a class="ccb-chip" href="#ccb-school">School Education</a>
<a class="ccb-chip" href="#ccb-energy">Energy</a>
<a class="ccb-chip" href="#ccb-mla">MLAs</a>
</nav>

<div class="ccb-pills">
<span class="ccb-pill">Municipal Administration</span>
<span class="ccb-pill">Urban Water Supply</span>
<span class="ccb-pill">PWD &amp; Highways</span>
<span class="ccb-pill">Finance</span>
<span class="ccb-pill">Industries</span>
<span class="ccb-pill">Textiles / MSME</span>
<span class="ccb-pill">Health</span>
<span class="ccb-pill">School Education</span>
<span class="ccb-pill">Energy</span>
</div>

<h2 id="ccb-profiles">Minister profiles &amp; Covai impact</h2>

<div class="ccb-cards">

<article class="ccb-card" id="ccb-cm">
<span class="ccb-tag">Chief Minister</span>
<h3>C. Joseph Vijay &mdash; Key Administrative Departments</h3>
<p>Directly handles Public &amp; General Administration, IAS, IPS, Police, Home, welfare departments and Municipal Administration, Urban and Water Supply.</p>
<p>Critical for Coimbatore: drinking water, UGD and stormwater, solid waste, ward grievances and corporation planning stay with the CM&rsquo;s office.</p>
<div class="ccb-angle"><strong>Covai angle</strong> Coimbatore Corporation water supply, tanker dependency in expanding suburbs, ward-level grievances and lake-linked stormwater need top-down coordination if urban governance is prioritised.</div>
</article>

<article class="ccb-card" id="ccb-aadhav">
<span class="ccb-tag">Public Works &amp; Sports</span>
<h3>Aadhav Arjuna &mdash; PWD &amp; Highways</h3>
<p>Public Works, Buildings, Highways, Minor Ports and Sports Development.</p>
<p>Avinashi Road, Mettupalayam Road and NH-544 carry heavy industrial and airport traffic; junction and flyover works shape daily commutes.</p>
<div class="ccb-angle"><strong>Covai angle</strong> Arterial maintenance, flyovers and estate access roads affect Peelamedu, Singanallur, Kalapatti and Saravanampatti belts directly.</div>
</article>

<article class="ccb-card" id="ccb-finance">
<span class="ccb-tag">Finance</span>
<h3>K.A. Sengottaiyan &mdash; Finance &amp; Pensions</h3>
<p>Finance, Pensions and Pension Allowances shape welfare schemes, infrastructure funding and public services.</p>
<div class="ccb-angle"><strong>Covai angle</strong> Budget lines for Smart City leftovers, bus terminals, lake restoration and district hospital upgrades depend on state finance, not local announcements alone.</div>
</article>

<article class="ccb-card" id="ccb-industries">
<span class="ccb-tag">Industries</span>
<h3>Selvi S. Keerthana &mdash; Industries &amp; Investment</h3>
<p>Industries and Investment Promotion &mdash; relevant to textiles, foundry, pump and motor units, TIDEL / IT parks on the Saravanampatti&ndash;Kalapatti axis and MSME employment.</p>
<div class="ccb-angle"><strong>Covai angle</strong> Strong promotion could expand jobs and leasing demand; transport and power must keep pace with new investment.</div>
</article>

<article class="ccb-card" id="ccb-school">
<span class="ccb-tag">School Education &amp; Publicity</span>
<h3>Rajmohan &mdash; Education &amp; Tamil Development</h3>
<p>School Education, Tamil culture, Information and Publicity, Government Press and related departments.</p>
<p>Coimbatore has dense corporation and matric school networks plus a TNPSC coaching hub.</p>
<div class="ccb-angle"><strong>Covai angle</strong> Track school access, quality, public communication and Tamil programmes across RS Puram, Gandhipuram and peri-urban wards.</div>
</article>

<article class="ccb-card" id="ccb-arunraj">
<span class="ccb-tag">Health &amp; Medical Education</span>
<h3>Dr. K.G. Arunraj &mdash; Health &amp; Family Welfare</h3>
<p>Health, Medical Education and Family Welfare. Growth in Sulur and Kinathukadavu belts increases pressure on CMCH, PSG, KMCH and peri-urban PHCs.</p>
<div class="ccb-angle"><strong>Covai angle</strong> Emergency care, maternity services and PHC coverage must keep pace in Peelamedu, Singanallur and southern corporation wards.</div>
</article>

<article class="ccb-card" id="ccb-energy">
<span class="ccb-tag">Energy &amp; Law</span>
<h3>R. Nirmalkumar &mdash; Power &amp; Governance</h3>
<p>Electricity, renewable energy, Law, Courts, Prisons, anti-corruption, elections and related departments.</p>
<div class="ccb-angle"><strong>Covai angle</strong> Load shedding in Peelamedu and Singanallur, industrial tariffs and rooftop solar incentives matter for factories and apartment towers alike.</div>
</article>

<article class="ccb-card" id="ccb-anand">
<span class="ccb-tag">Rural Development &amp; Water</span>
<h3>N. Anand &mdash; Panchayats &amp; Irrigation</h3>
<p>Rural Development, Panchayats, poverty alleviation and irrigation beyond corporation limits.</p>
<div class="ccb-angle"><strong>Covai angle</strong> Peri-urban tanks, Siruvani-linked water narratives and panchayat belts outside the corporation need urban&ndash;rural coordination.</div>
</article>

<article class="ccb-card" id="ccb-food">
<span class="ccb-tag">Food &amp; Civil Supplies</span>
<h3>P. Venkataramanan &mdash; Ration &amp; Consumer Protection</h3>
<p>Food and Civil Supplies, Consumer Protection and Price Control affect ration shops and essential commodities.</p>
<div class="ccb-angle"><strong>Covai angle</strong> Food security matters for hostel populations, factory workers and markets around Ukkadam and Gandhipuram.</div>
</article>

<article class="ccb-card" id="ccb-mines">
<span class="ccb-tag">Natural Resources</span>
<h3>Dr. TK. Prabhu &mdash; Minerals &amp; Mines</h3>
<p>Minerals and Mines governance affects construction materials, quarry regulation and the environment across the district.</p>
<div class="ccb-angle"><strong>Covai angle</strong> Sand and quarry rules influence building costs and environmental compliance as Covai keeps expanding.</div>
</article>

</div>

<h2 id="ccb-mla">Coimbatore district MLAs (Assembly 2026)</h2>
<p>After the 23 April 2026 poll and counting on 4 May, these are the elected MLAs for the six Assembly constituencies in the Coimbatore Lok Sabha segment covered on MyCovai. Verify final figures on the <a href="https://results.eci.gov.in" target="_blank" rel="noopener">ECI</a> or <a href="https://elections.tn.gov.in" target="_blank" rel="noopener">CEO Tamil Nadu</a> portals.</p>

<div class="ccb-table-wrap">
<table class="ccb-cabinet-table" aria-label="Coimbatore Assembly MLAs 2026">
<thead><tr><th>AC name</th><th>AC no.</th><th>MLA (2026)</th><th>Party</th><th>Link</th></tr></thead>
<tbody>
{$mlaRows}
</tbody>
</table>
</div>

<p class="ccb-disclaimer">MLAs represent assembly constituencies; cabinet ministers hold state departments. An MLA may or may not be a minister.</p>
<p class="ccb-mla-note">Other Coimbatore district seats (e.g. Mettupalayam, Thondamuthur, Kinathukadavu, Pollachi, Valparai) are listed on statewide results pages. Full Covai hub: <a href="{$resultsUrl}">Elections 2026 results</a>.</p>

<h2>Why This Matters for Covai</h2>
<p>Coimbatore is a dense mix of textile units, IT parks, hospitals, schools, markets, peri-urban tanks and rapidly growing suburbs.</p>

<div class="ccb-grid">
<div class="ccb-grid-item"><h4>Municipal &amp; Water</h4><p>Corporation water, UGD and civic services under the Chief Minister.</p></div>
<div class="ccb-grid-item"><h4>PWD &amp; Highways</h4><p>Avinashi Road, NH-544 and junction works.</p></div>
<div class="ccb-grid-item"><h4>Industries</h4><p>Textiles, foundry, MSME and TIDEL-axis jobs.</p></div>
<div class="ccb-grid-item"><h4>Energy</h4><p>Power for industry and residential towers.</p></div>
<div class="ccb-grid-item"><h4>Education &amp; Health</h4><p>Schools and CMCH&ndash;PSG&ndash;KMCH pressure.</p></div>
<div class="ccb-grid-item"><h4>Finance</h4><p>Funding that turns plans into execution.</p></div>
</div>

<h2>What Covai Residents Should Track Next</h2>
<ul class="ccb-checklist">
<li>Whether corporation water and UGD projects receive priority</li>
<li>Whether Avinashi Road, Mettupalayam Road and NH-544 maintenance improves</li>
<li>Whether PHCs and hospital access expand in peri-urban growth belts</li>
<li>Whether schools and civic facilities keep pace with population growth</li>
<li>Whether industrial investment brings planned infrastructure, not only congestion</li>
<li>Whether corporation, panchayats and state departments coordinate better</li>
</ul>

<div class="ccb-view">
<h2>MyCovai View</h2>
<p>The cabinet allocation clarifies where responsibility now lies statewide. For Coimbatore, the key signal is the Chief Minister retaining Municipal Administration, Urban and Water Supply, while PWD, Highways, Finance, Industries, Energy, Health and School Education sit with dedicated ministers. Pair this with your <a href="{$resultsUrl}" style="color:#f5c4a8">local MLA</a> for assembly-level representation.</p>
</div>

<h2>Sources &amp; references</h2>
<p>Official portfolio list: <a href="https://mychennaicity.in/documents/tamil-nadu-cabinet-portfolios-may-2026/lok-bhavan-press-release-no-38-16-05-2026.pdf" target="_blank" rel="noopener">Lok Bhavan Press Release No. 38 (PDF)</a>. Hero image (Tamil Nadu Secretariat): <a href="https://images.news9live.com/wp-content/uploads/2025/06/Tamil-Nadu-govt.jpg" target="_blank" rel="noopener">News9Live</a> (external). Additional reporting: DT Next, The Times of India, The New Indian Express. MyCovai summarises governance updates for Coimbatore readers; verify official notifications for final orders.</p>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Who is the Chief Minister of Tamil Nadu after the 2026 cabinet allocation?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "C. Joseph Vijay is Chief Minister and holds Home, Police, Public Administration, Municipal Administration, Urban and Water Supply, among other portfolios, per Lok Bhavan Press Release No. 38 dated 16 May 2026."
      }
    },
    {
      "@type": "Question",
      "name": "Which minister handles highways and PWD works relevant to Coimbatore?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Aadhav Arjuna is Minister for Public Works and Sports Development, with Public Works, Buildings, Highways and Minor Ports in his portfolio."
      }
    },
    {
      "@type": "Question",
      "name": "How is an MLA different from a cabinet minister?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "MLAs are elected to represent one Assembly constituency. Cabinet ministers are appointed to run state departments. An MLA may or may not also be a minister."
      }
    }
  ]
}
</script>

</div>
HTML;
}
