<?php
/**
 * HTML body: Kongu Tamil regional dictionary article (English).
 */
declare(strict_types=1);

function kongu_dictionary_article_html(): string
{
    $pdfUrl = 'https://mycovai.in/downloads/%E0%AE%95%E0%AF%8A%E0%AE%99%E0%AF%8D%E0%AE%95%E0%AF%81_%E0%AE%B5%E0%AE%9F%E0%AF%8D%E0%AE%9F%E0%AE%BE%E0%AE%B0%E0%AE%9A%E0%AF%8D_%E0%AE%9A%E0%AF%8A%E0%AE%B2%E0%AF%8D%E0%AE%B2%E0%AE%95%E0%AE%B0%E0%AE%BE%E0%AE%A4%E0%AE%BF_Kongu_Tamil_Words.pdf';
    $pdfUrlEsc = htmlspecialchars($pdfUrl, ENT_QUOTES, 'UTF-8');
    $wikiUrl = 'https://en.wikipedia.org/wiki/Kongu_Tamil';
    $hinduUrl = 'https://www.thehindu.com/opinion/op-ed/in-defence-of-the-chronicler-of-kongu/article6778031.ece';

    return <<<HTML
<style>
.kongu-dict-feature{font-family:Poppins,system-ui,sans-serif;color:#1a1a1a;line-height:1.65;max-width:920px;margin:0 auto}
.kongu-dict-feature h2,.kongu-dict-feature h3{font-family:Poppins,sans-serif!important;font-weight:700!important;margin-top:1.75rem;margin-bottom:.75rem}
.kongu-dict-feature .kd-eyebrow{font-size:.85rem;text-transform:uppercase;letter-spacing:.06em;color:#8B3D24;font-weight:600;margin-bottom:.5rem}
.kongu-dict-feature .kd-lead{font-size:1.15rem;color:#333;margin:1rem 0 1.5rem}
.kongu-dict-feature .kd-download-box{background:linear-gradient(135deg,#fdf6f2 0%,#f5ebe6 100%);border:2px solid #B8522E;border-radius:14px;padding:1.5rem 1.75rem;margin:1.75rem 0;text-align:center}
.kongu-dict-feature .kd-download-box h2{margin-top:0!important;color:#8B3D24!important;font-size:1.35rem!important}
.kongu-dict-feature .kd-download-box p{margin:.75rem 0 1.25rem;color:#444}
.kongu-dict-feature .kd-download-btn{display:inline-block;background:#B8522E;color:#fff!important;padding:.85rem 1.75rem;border-radius:999px;font-weight:700;font-size:1.05rem;text-decoration:none;box-shadow:0 4px 14px rgba(184,82,46,.35);transition:background .2s,transform .15s}
.kongu-dict-feature .kd-download-btn:hover{background:#8B3D24;transform:translateY(-1px)}
.kongu-dict-feature .kd-download-meta{font-size:.85rem;color:#666;margin-top:1rem}
.kongu-dict-feature .kd-sample-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem;margin:1.5rem 0}
@media(max-width:640px){.kongu-dict-feature .kd-sample-grid{grid-template-columns:1fr}}
.kongu-dict-feature .kd-sample-item{background:#fafafa;border:1px solid #eee;border-radius:10px;padding:1rem 1.1rem}
.kongu-dict-feature .kd-sample-item strong{display:block;color:#8B3D24;font-size:1.05rem;margin-bottom:.25rem}
.kongu-dict-feature .kd-sample-item span{font-size:.9rem;color:#555}
.kongu-dict-feature .kd-note{background:#f9f9f9;border-left:4px solid #B8522E;padding:1rem 1.25rem;margin:1.5rem 0;font-size:.95rem;border-radius:0 8px 8px 0}
.kongu-dict-feature .kd-disclaimer{background:#fff8f0;border:1px solid #e8d4c8;border-radius:10px;padding:1rem 1.25rem;margin:1.25rem 0;font-size:.92rem;color:#444}
.kongu-dict-feature .kd-disclaimer strong{color:#8B3D24}
.kongu-dict-feature .kd-sources{font-size:.9rem;color:#666;margin-top:2rem;padding-top:1rem;border-top:1px solid #eee}
.kongu-dict-feature .kd-sources a{color:#8B3D24}
.kongu-dict-feature ul{padding-left:1.25rem}
.kongu-dict-feature li{margin-bottom:.45rem}
</style>

<div class="kongu-dict-feature">

<p class="kd-eyebrow">Coimbatore &amp; Covai &middot; Language &amp; culture &middot; Free resource</p>

<p class="kd-lead">If you have ever heard elders in Gandhipuram, RS Puram or a village near Pollachi use words that sound like Tamil but do not appear in school textbooks, you are listening to <strong>Kongu Tamil</strong> &mdash; the living dialect of western Tamil Nadu. MyCovai is helping make a regional dictionary easier to find and download &mdash; as a small contribution to Tamil language, the Tamil community and our local dialects.</p>

<div class="kd-disclaimer">
<strong>Copyright &amp; attribution:</strong> This dictionary is <em>not</em> a MyCovai publication. All rights in the text belong to the original author and publisher. MyCovai does not claim ownership of this work. We are only hosting a download link to help readers discover and access it, in support of Tamil language and Kongu dialect preservation. If you are the rights holder and wish the link removed or updated, please <a href="/contact.php">contact us</a>.
</div>

<div class="kd-download-box">
<h2>&#128214; Download: Kongu Regional Tamil Dictionary</h2>
<p><strong>&#x0B95;&#x0BCA;&#x0B99;&#x0BCD;&#x0B95;&#x0BC1; &#x0BB5;&#x0B9F;&#x0BCD;&#x0B9F;&#x0BBE;&#x0BB0;&#x0B9A;&#x0BCD; &#x0B9A;&#x0BCA;&#x0BB2;&#x0BCD;&#x0BB2;&#x0B95;&#x0BB0;&#x0BBE;&#x0BA4;&#x0BBF;</strong> &mdash; a dictionary of Kongu dialect words spoken across Coimbatore, Erode, Tiruppur and the wider Kongu region.</p>
<a class="kd-download-btn" href="{$pdfUrlEsc}" download target="_blank" rel="noopener">&#11015; Download PDF (Free)</a>
<p class="kd-download-meta">Facilitated by MyCovai for community access &middot; PDF &middot; Tamil script &middot; Rights remain with author &amp; publisher</p>
</div>

<h2>What is Kongu Tamil?</h2>

<p>Kongu Tamil &mdash; also called <em>Kovai Tamil</em>, <em>Kongu Pechu</em> or <em>Kongalam</em> &mdash; is the dialect spoken in Kongu Nadu, the fertile western belt of Tamil Nadu centred on Coimbatore. Linguists and speakers note several traits that set it apart from Chennai-centred standard Tamil:</p>

<ul>
<li><strong>Distinct pronunciation</strong> &mdash; many Coimbatore speakers use the alveolar &#x0BB1; (tra/dra sound) where standard Tamil uses retroflex &#x0B9F;/&#x0B9F; (da/ta).</li>
<li><strong>Honorific endings</strong> &mdash; respectful speech often ends with guttural nasal &#x0B99; sounds, as in &#x0BB5;&#x0BBE;&#x0B99;&#x0BCD; (<em>vaang</em>) for &ldquo;please come&rdquo; in a polite tone.</li>
<li><strong>Agricultural vocabulary</strong> &mdash; words tied to farming, cattle, weaving and local trade survive here even when they fade elsewhere.</li>
<li><strong>Neighbouring influences</strong> &mdash; centuries of contact with Kannada- and Malayalam-speaking regions left loan words in everyday Kongu speech.</li>
</ul>

<p>Today, urbanisation, television and schooling push many young Covai residents toward standard Tamil. That makes written records of the dialect especially valuable.</p>

<h2>About this dictionary</h2>

<p>The PDF available above is titled <strong>&#x0B95;&#x0BCA;&#x0B99;&#x0BCD;&#x0B95;&#x0BC1; &#x0BB5;&#x0B9F;&#x0BCD;&#x0B9F;&#x0BBE;&#x0BB0;&#x0B9A;&#x0BCD; &#x0B9A;&#x0BCA;&#x0BB2;&#x0BCD;&#x0BB2;&#x0B95;&#x0BB0;&#x0BBE;&#x0BA4;&#x0BBF;</strong> (<em>Kongu Vattara Chollagarathi</em> &mdash; A Dictionary of Kongu Tamil Words). It belongs to a tradition of regional Tamil lexicons that document how people actually speak, not just how textbooks say they should.</p>

<p>The best-known scholarly reference in this line is <strong>Perumal Murugan</strong>&rsquo;s <em>Konku Vatt&#257;rac collakar&#257;ti</em>, compiled over many years and published in 2000. Murugan &mdash; the acclaimed novelist from Kongu Nadu &mdash; began collecting dialect words as a college student in Erode in 1983, inspired by a Karisal-region dictionary. He gathered terms from friends, relatives and oral tradition across Coimbatore, Erode, Tiruppur, Salem and Karur. The resulting work is cited in university language collections and sociolinguistic studies as a key record of Kongu speech.</p>

<div class="kd-note">
<strong>Why MyCovai is facilitating this</strong><br>
We are a local Coimbatore community platform, not a publisher. By pointing readers to this dictionary, we hope to support Tamil language learning, celebrate Kongu dialect heritage, and help students, writers, journalists and families keep regional words alive. Coimbatore is changing fast &mdash; save the PDF, share it with elders who still remember the old words, and use it when you hear something unfamiliar. Again: credit and copyright rest with the original author and publisher, not MyCovai.
</div>

<h2>Sample Kongu words you may recognise</h2>

<p>Every neighbourhood has its own flavour, but these examples illustrate the gap between Kongu usage and textbook Tamil:</p>

<div class="kd-sample-grid">
<div class="kd-sample-item"><strong>&#x0BB5;&#x0BBE;&#x0B99;&#x0BCD; / &#x0BB5;&#x0BBE;&#x0B99;&#x0BCA;</strong><span>Polite &ldquo;come&rdquo; &mdash; characteristic Kongu honorific ending</span></div>
<div class="kd-sample-item"><strong>&#x0B95;&#x0BCA;&#x0B99;&#x0BCD;&#x0B95;&#x0BC1;&#x0BAA;&#x0BCD;&#x0BAA;&#x0BC7;&#x0B9A;&#x0BC1;</strong><span>Kongu speech &mdash; what locals call their own dialect</span></div>
<div class="kd-sample-item"><strong>&#x0B95;&#x0BCA;&#x0BB5;&#x0BC8; &#x0BA4;&#x0BAE;&#x0BBF;&#x0BB4;&#x0BCD;</strong><span>Coimbatore Tamil &mdash; urban Kongu variety heard across the city</span></div>
<div class="kd-sample-item"><strong>Regional farming &amp; kinship terms</strong><span>The dictionary lists hundreds of words for crops, tools, relationships and daily life unique to Kongu Nadu</span></div>
</div>

<h2>Who will find this useful?</h2>

<ul>
<li><strong>Students and teachers</strong> studying Tamil linguistics or regional literature</li>
<li><strong>Writers and journalists</strong> aiming for authentic Coimbatore dialogue</li>
<li><strong>Families</strong> who want children to understand grandparents&rsquo; expressions</li>
<li><strong>Anyone new to Covai</strong> puzzled by words they hear on an auto ride or at a tea shop</li>
</ul>

<p>Download the PDF using the button above and keep a piece of Kongu Nadu&rsquo;s voice on your phone or laptop.</p>

<p class="kd-sources"><strong>Further reading:</strong> <a href="{$wikiUrl}" target="_blank" rel="noopener noreferrer">Kongu Tamil (Wikipedia)</a> &middot; <a href="{$hinduUrl}" target="_blank" rel="noopener noreferrer">Perumal Murugan, chronicler of Kongu (<em>The Hindu</em>)</a></p>

</div>
HTML;
}
