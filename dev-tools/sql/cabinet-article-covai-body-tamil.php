<?php
/**
 * Tamil HTML body for Tamil Nadu cabinet portfolios article (Coimbatore / Covai).
 */
declare(strict_types=1);

require_once __DIR__ . '/cabinet-article-covai-body.php';

function covai_cabinet_article_html_tamil(string $electionsBase = '/coimbatore-elections-2026'): string
{
    $mlaRows = covai_cabinet_article_build_mla_table($electionsBase, 'ta');
    $resultsUrl = htmlspecialchars($electionsBase . '/results-2026.php', ENT_QUOTES, 'UTF-8');
    $myomrSister = 'https://myomr.in/local-news/tamil-nadu-cabinet-portfolios-announced-chennai-omr-impact';

    return <<<HTML
<style>
.covai-cabinet-feature{font-family:Poppins,"Noto Sans Tamil",system-ui,sans-serif;color:#1a1a1a;line-height:1.75;max-width:920px;margin:0 auto}
.covai-cabinet-feature h2,.covai-cabinet-feature h3{font-family:Poppins,"Noto Sans Tamil",sans-serif!important;font-weight:700!important;margin-top:1.75rem;margin-bottom:.75rem}
.covai-cabinet-feature .ccb-eyebrow{font-size:.85rem;text-transform:uppercase;letter-spacing:.04em;color:#8B3D24;font-weight:600;margin-bottom:.5rem}
.covai-cabinet-feature .ccb-lead{font-size:1.12rem;color:#333;margin:1rem 0 1.5rem}
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
.covai-cabinet-feature .ccb-view{background:#1a1a1a;color:#f5f5f5;padding:1.25rem;border-radius:10px;margin:1.5rem 0}
.covai-cabinet-feature .ccb-view h2{color:#fff!important;margin-top:0!important}
.covai-cabinet-feature .ccb-sister{font-size:.9rem;color:#666;margin:1rem 0;padding:.75rem;background:#f9f9f9;border-radius:8px}
.covai-cabinet-feature .ccb-hero-img{width:100%;max-height:420px;object-fit:cover;border-radius:10px;margin:1rem 0}
.covai-cabinet-feature .ccb-disclaimer{font-size:.85rem;color:#666;font-style:italic}
</style>

<div class="covai-cabinet-feature" lang="ta">

<p class="ccb-eyebrow">கோயம்புத்தூர் &amp; கோவை &middot; மாநில நிர்வாகம் &middot; 16 மே 2026</p>

<p class="ccb-lead">முதலமைச்சர் C. Joseph Vijay தலைமையில் துறை அளவிலான ஆட்சி தொடங்குவதற்கான பொறுப்புப் பிரிப்பு அறிவிக்கப்பட்டுள்ளது. நகராட்சி நீர், சாலைகள், தொழில், கல்வி, சுகாதாரம், மின்சாரம் ஆகியவற்றில் கோவைக்கு நேரடி தாக்கம் உண்டு.</p>

<p>தமிழ்நாடு அமைச்சரவை உறுப்பினர்களுக்கு பொறுப்புகள் ஒதுக்கப்பட்டுள்ளன. ஆறு பள்ளி, மருத்துவமனை, மின்சாரம், நிதி, நகராட்சி நிர்வாகம் என்பவை ராசிபுரம், காந்திபுரம், பீலாமேடு, சिंகாநல்லூர், சரவணம்பட்டி, கலப்பட்டி உள்ளிட்ட பகுதிகளில் வாழ்பவர்களைப் பாதிக்கும்.</p>

<p><strong>கோயம்புத்தூர், 16 மே 2026</strong> &mdash; லோக் பவன் செய்தி வெளியீடு எண் 38 (16.05.2026) படி, முதலமைச்சர் பொறுப்புப் பிரிப்புகளை ஆளுநருக்கு பரிந்துரைத்தார்; ஆளுநர் ஒப்புதல் அளித்தார். விஜய் உள்துறை, காவல்துறை, பொதுநிர்வாகம் போன்ற துறைகளைத் தக்க வைத்துள்ளார் என்று செய்திகள் தெரிவிக்கின்றன.</p>

<div class="ccb-source-box">
<p><strong>அதிகாரப்பூர்வ ஆதாரம்:</strong> லோக் பவன் செய்தி வெளியீடு எண் 38 (16 மே 2026). முழு அமைச்சர்கள் பட்டியலுக்கு PDF பதிவிறக்கம் செய்யவும்.</p>
<p><a href="https://mychennaicity.in/documents/tamil-nadu-cabinet-portfolios-may-2026/lok-bhavan-press-release-no-38-16-05-2026.pdf" target="_blank" rel="noopener">செய்தி வெளியீடு PDF பதிவிறக்கம்</a></p>
</div>

<div class="ccb-sister">சென்னை / OMR வாசிகளுக்கு: <a href="{$myomrSister}" rel="noopener">MyOMR &mdash; சென்னை மற்றும் OMR கட்டுரை</a> பார்க்கவும். <a href="https://mycovai.in/local-news/tamil-nadu-cabinet-portfolios-announced-coimbatore-covai-impact">English</a></div>

<img class="ccb-hero-img" src="https://images.news9live.com/wp-content/uploads/2025/06/Tamil-Nadu-govt.jpg" alt="தமிழ்நாடு செயலகம்" width="1200" height="630" loading="lazy">

<h2 id="ccb-full-list">முழு அமைச்சரவை பொறுப்புப் பட்டியல்</h2>

<div class="ccb-table-wrap">
<table class="ccb-cabinet-table" aria-label="தமிழ்நாடு அமைச்சரவை பொறுப்புகள் மே 2026">
<thead><tr><th>அமைச்சர்</th><th>பதவி</th><th>முக்கியத் துறைகள்</th></tr></thead>
<tbody>
<tr class="ccb-cm-row"><td><a href="#ccb-cm">C. Joseph Vijay</a></td><td>முதலமைச்சர்</td><td>உள்துறை, காவல்துறை, பொதுநிர்வாகம், நகராட்சி நிர்வாகம், நகர நீர்வழங்கல், நலத்துறைகள்</td></tr>
<tr><td><a href="#ccb-anand">N. Anand</a></td><td>ஊரக வளர்ச்சி &amp; நீர்வளத் துறை அமைச்சர்</td><td>ஊரக வளர்ச்சி, பஞ்சாயத்துகள், வறுமைத் தடுப்பு, பாசனம்</td></tr>
<tr><td><a href="#ccb-aadhav">Aadhav Arjuna</a></td><td>பொதுப்பணித்துறை &amp; விளையாட்டு அமைச்சர்</td><td>பொதுப்பணிகள், கட்டிடங்கள், நெடுஞ்சாலைகள், சிற்றுறைமுகங்கள், விளையாட்டு</td></tr>
<tr><td><a href="#ccb-arunraj">Dr. K.G. Arunraj</a></td><td>சுகாதாரம் அமைச்சர்</td><td>சுகாதாரம், மருத்துவக் கல்வி, குடும்ப நலம்</td></tr>
<tr><td><a href="#ccb-finance">K.A. Sengottaiyan</a></td><td>நிதி அமைச்சர்</td><td>நிதி, ஓய்வூதியம்</td></tr>
<tr><td><a href="#ccb-food">P. Venkataramanan</a></td><td>உணவு &amp; பொது விநியோக அமைச்சர்</td><td>உணவு, பொது விநியோகம், நுகர்வோர் பாதுகாப்பு, விலைக் கட்டுப்பாடு</td></tr>
<tr><td><a href="#ccb-energy">R. Nirmalkumar</a></td><td>மின்சாரம் &amp; சட்ட அமைச்சர்</td><td>மின்சாரம், புதுப்பிக்கத்தக்க ஆற்றல், சட்டம், நீதிமன்றங்கள்</td></tr>
<tr><td><a href="#ccb-school">Rajmohan</a></td><td>பள்ளிக்கல்வி அமைச்சர்</td><td>பள்ளிக்கல்வி, தமிழ், தகவல் &amp; வெளியீடு</td></tr>
<tr><td><a href="#ccb-mines">Dr. TK. Prabhu</a></td><td>இயற்கை வளங்கள் அமைச்சர்</td><td>கனிமங்கள் &amp; சுரங்கங்கள்</td></tr>
<tr><td><a href="#ccb-industries">Selvi S. Keerthana</a></td><td>தொழில்துறை அமைச்சர்</td><td>தொழில்கள், முதலீடு ஊக்குவிப்பு</td></tr>
</tbody>
</table>
</div>

<nav class="ccb-chips" aria-label="அமைச்சர் சுருக்க இணைப்பு">
<a class="ccb-chip" href="#ccb-cm">முதல்வர்</a>
<a class="ccb-chip" href="#ccb-aadhav">பொதுப்பணி</a>
<a class="ccb-chip" href="#ccb-finance">நிதி</a>
<a class="ccb-chip" href="#ccb-industries">தொழில்</a>
<a class="ccb-chip" href="#ccb-arunraj">சுகாதாரம்</a>
<a class="ccb-chip" href="#ccb-mla">எம்எல்ஏ</a>
</nav>

<h2 id="ccb-profiles">அமைச்சர் விவரங்கள் &amp; கோவை தாக்கம்</h2>

<div class="ccb-cards">

<article class="ccb-card" id="ccb-cm">
<span class="ccb-tag">முதலமைச்சர்</span>
<h3>C. Joseph Vijay</h3>
<p>நகராட்சி நிர்வாகம், நகர நீர்வழங்கல் உள்ளிட்ட முக்கியத் துறைகள் முதலமைச்சர் பொறுப்பில்.</p>
<div class="ccb-angle"><strong>கோவை கோணம்</strong> கோவை மாநகராட்சி குடிநீர், கழிவுநீர்/மழைநீர் வடிகால், வார்டு முறையீடுகள், விரிவாகும் புறநகரங்களில் டேங்கர் நம்பகம்.</div>
</article>

<article class="ccb-card" id="ccb-aadhav">
<span class="ccb-tag">பொதுப்பணி</span>
<h3>Aadhav Arjuna &mdash; பொதுப்பணி &amp; நெடுஞ்சாலைகள்</h3>
<p>அவினாசி சாலை, மெட்டுப்பாளையம் சாலை, NH-544 போன்ற முக்கிய வழித்தடங்கள்.</p>
<div class="ccb-angle"><strong>கோவை கோணம்</strong> மேம்பால்கள், சாலை பராமரிப்பு &mdash; பீலாமேடு, சिंகாநல்லூர், கலப்பட்டி, சரவணம்பட்டி பகுதிகளுக்கு நேரடி.</div>
</article>

<article class="ccb-card" id="ccb-finance">
<span class="ccb-tag">நிதி</span>
<h3>K.A. Sengottaiyan</h3>
<div class="ccb-angle"><strong>கோவை கோணம்</strong> ஸ்மார்ட் சிட்டி மீதமுள்ள பணம், பேருந்து நிலையங்கள், ஏரி மறுசீரமைப்பு, மாவட்ட மருத்துவமனை மேம்பாடு.</div>
</article>

<article class="ccb-card" id="ccb-industries">
<span class="ccb-tag">தொழில்</span>
<h3>Selvi S. Keerthana</h3>
<p>ஜவுளி, வார்ப்பு, பம்ப்/மோட்டார் பெல்ட், சரவணம்பட்டி&ndash;கலப்பட்டி IT பூங்கா, MSME வேலைவாய்ப்பு.</p>
<div class="ccb-angle"><strong>கோவை கோணம்</strong> முதலீடு வளர்ந்தால் போக்குவரத்து, மின்சாரம் இணைந்து வளர வேண்டும்.</div>
</article>

<article class="ccb-card" id="ccb-school">
<span class="ccb-tag">கல்வி</span>
<h3>Rajmohan</h3>
<div class="ccb-angle"><strong>கோவை கோணம்</strong> மாநகர &amp; மெட்ரிக் பள்ளிகள், TNPSC பயிற்சி மையங்கள் &mdash; அணுகல், தரம் கண்காணிக்கவும்.</div>
</article>

<article class="ccb-card" id="ccb-arunraj">
<span class="ccb-tag">சுகாதாரம்</span>
<h3>Dr. K.G. Arunraj</h3>
<div class="ccb-angle"><strong>கோவை கோணம்</strong> CMCH, PSG, KMCH அழுத்தம்; சூலூர், கிணத்துக்கடவு புறநகர PHC தேவை.</div>
</article>

<article class="ccb-card" id="ccb-energy">
<span class="ccb-tag">மின்சாரம்</span>
<h3>R. Nirmalkumar</h3>
<div class="ccb-angle"><strong>கோவை கோணம்</strong> பீலாமேடு, சिंகாநல்லூர் மின்தடை; தொழிற்சாலை கட்டணம்; கூரை சூரிய மின்.</div>
</article>

<article class="ccb-card" id="ccb-anand">
<span class="ccb-tag">ஊரக வளர்ச்சி</span>
<h3>N. Anand</h3>
<div class="ccb-angle"><strong>கோவை கோணம்</strong> புறநகர் ஏரிகள், சிறுவணி நீர் கதைகள், மாநகர வெளியே பஞ்சாயத்து பகுதிகள்.</div>
</article>

<article class="ccb-card" id="ccb-food">
<span class="ccb-tag">உணவு</span>
<h3>P. Venkataramanan</h3>
<div class="ccb-angle"><strong>கோவை கோணம்</strong> ரேஷன் கடைகள், தொழிலாளர்/hostel மக்கள், உக்கடம்/காந்திபுரம் சந்தை விலை.</div>
</article>

<article class="ccb-card" id="ccb-mines">
<span class="ccb-tag">கனிமங்கள்</span>
<h3>Dr. TK. Prabhu</h3>
<div class="ccb-angle"><strong>கோவை கோணம்</strong> மணல்/குவாரி விதிகள் கட்டுமானச் செலவு, சுற்றுச்சூழலைப் பாதிக்கும்.</div>
</article>

</div>

<h2 id="ccb-mla">கோயம்புத்தூர் மாவட்ட எம்எல்ஏக்கள் (2026 சட்டமன்றத் தேர்தல்)</h2>
<p>23 ஏப்ரல் 2026 தேர்தல், 4 மே எண்ணிக்கைக்குப் பிறகு &mdash; MyCovai கோவை லோக்சபா பிரிவின் ஆறு தொகுதிகள். இறுதி எண்கள்: <a href="https://results.eci.gov.in" target="_blank" rel="noopener">ECI</a> / <a href="https://elections.tn.gov.in" target="_blank" rel="noopener">தமிழ்நாடு தலைமைத் தேர்தல் அதிகாரி</a>.</p>

<div class="ccb-table-wrap">
<table class="ccb-cabinet-table" aria-label="கோவை எம்எல்ஏ பட்டியல் 2026">
<thead><tr><th>தொகுதி</th><th>எண்</th><th>எம்எல்ஏ (2026)</th><th>கட்சி</th><th>இணைப்பு</th></tr></thead>
<tbody>
{$mlaRows}
</tbody>
</table>
</div>

<p class="ccb-disclaimer">எம்எல்ஏக்கள் சட்டமன்றத் தொகுதியைப் பிரதிநிதித்துவப்படுத்துகிறார்கள்; அமைச்சர்கள் மாநிலத் துறைகளை நிர்வகிக்கிறார்கள். ஒருவர் இரண்டு பாத்திரங்களும் வகிக்கலாம் அல்லது வகிக்காமல் இருக்கலாம்.</p>
<p><a href="{$resultsUrl}">தேர்தல் 2026 முடிவுகள்</a></p>

<h2>கோவைக்கு ஏன் முக்கியம்?</h2>
<div class="ccb-grid">
<div class="ccb-grid-item"><h4>நகராட்சி &amp; நீர்</h4><p>மாநகர நீர், UGD.</p></div>
<div class="ccb-grid-item"><h4>சாலைகள்</h4><p>அவினாசி சாலை, NH-544.</p></div>
<div class="ccb-grid-item"><h4>தொழில்</h4><p>ஜவுளி, MSME, IT.</p></div>
<div class="ccb-grid-item"><h4>மின்சாரம்</h4><p>தொழில் &amp; குடியிருப்பு.</p></div>
<div class="ccb-grid-item"><h4>கல்வி &amp; சுகாதாரம்</h4><p>பள்ளி, மருத்துவமனை.</p></div>
<div class="ccb-grid-item"><h4>நிதி</h4><p>திட்டம் செயல்படுத்தல்.</p></div>
</div>

<h2>கோவை வாசிகள் கவனிக்க வேண்டியவை</h2>
<ul class="ccb-checklist">
<li>மாநகர குடிநீர், கழிவுநீர் திட்டங்களுக்கு முன்னுரிமை</li>
<li>அவினாசி, மெட்டுப்பாளையம் சாலை பராமரிப்பு</li>
<li>PHC, மருத்துவமனை அணுகல் விரிவாக்கம்</li>
<li>பள்ளி, நகர்ப்புற வசதிகள் மக்கள்தொகைக்கு ஈடா?</li>
<li>தொழில் முதலீடு &mdash; கட்டமைப்பு உடன் வருகிறதா?</li>
</ul>

<div class="ccb-view">
<h2>MyCovai கருத்து</h2>
<p>முதலமைச்சர் நகராட்சி நிர்வாகம், நகர நீர்வழங்கலைத் தக்க வைத்துள்ளார்; பொதுப்பணி, நெடுஞ்சாலை, நிதி, தொழில், மின்சாரம், சுகாதாரம், பள்ளிக்கல்விக்கு தனி அமைச்சர்கள். உங்கள் <a href="{$resultsUrl}" style="color:#f5c4a8">உள்ளூர் எம்எல்ஏ</a>யுடன் இணைந்து பார்க்கவும்.</p>
</div>

<h2>ஆதாரங்கள்</h2>
<p><a href="https://mychennaicity.in/documents/tamil-nadu-cabinet-portfolios-may-2026/lok-bhavan-press-release-no-38-16-05-2026.pdf" target="_blank" rel="noopener">லோக் பவன் PDF</a>. படம்: News9Live. DT Next, Times of India, The New Indian Express.</p>

</div>
HTML;
}
