<?php
declare(strict_types=1);

function kongu_dictionary_article_html_tamil(): string
{
    $pdfUrl = 'https://mycovai.in/downloads/%E0%AE%95%E0%AF%8A%E0%AE%99%E0%AF%8D%E0%AE%95%E0%AF%81_%E0%AE%B5%E0%AE%9F%E0%AF%8D%E0%AE%9F%E0%AE%BE%E0%AE%B0%E0%AE%9A%E0%AF%8D_%E0%AE%9A%E0%AF%8A%E0%AE%B2%E0%AF%8D%E0%AE%B2%E0%AE%95%E0%AE%B0%E0%AE%BE%E0%AE%A4%E0%AE%BF_Kongu_Tamil_Words.pdf';
    $pdfUrlEsc = htmlspecialchars($pdfUrl, ENT_QUOTES, 'UTF-8');

    return <<<HTML
<style>
.kongu-dict-feature{font-family:Poppins,"Noto Sans Tamil",system-ui,sans-serif;color:#1a1a1a;line-height:1.75;max-width:920px;margin:0 auto}
.kongu-dict-feature h2{font-weight:700!important;margin-top:1.75rem;margin-bottom:.75rem}
.kongu-dict-feature .kd-eyebrow{font-size:.85rem;color:#8B3D24;font-weight:600;margin-bottom:.5rem}
.kongu-dict-feature .kd-lead{font-size:1.12rem;color:#333;margin:1rem 0 1.5rem}
.kongu-dict-feature .kd-download-box{background:linear-gradient(135deg,#fdf6f2 0%,#f5ebe6 100%);border:2px solid #B8522E;border-radius:14px;padding:1.5rem 1.75rem;margin:1.75rem 0;text-align:center}
.kongu-dict-feature .kd-download-box h2{margin-top:0!important;color:#8B3D24!important;font-size:1.3rem!important}
.kongu-dict-feature .kd-download-btn{display:inline-block;background:#B8522E;color:#fff!important;padding:.85rem 1.75rem;border-radius:999px;font-weight:700;text-decoration:none}
.kongu-dict-feature .kd-download-meta{font-size:.85rem;color:#666;margin-top:1rem}
.kongu-dict-feature .kd-note{background:#f9f9f9;border-left:4px solid #B8522E;padding:1rem 1.25rem;margin:1.5rem 0}
.kongu-dict-feature .kd-disclaimer{background:#fff8f0;border:1px solid #e8d4c8;border-radius:10px;padding:1rem 1.25rem;margin:1.25rem 0;font-size:.92rem;color:#444}
.kongu-dict-feature .kd-disclaimer strong{color:#8B3D24}
.kongu-dict-feature ul{padding-left:1.25rem}
.kongu-dict-feature li{margin-bottom:.45rem}
</style>
<div class="kongu-dict-feature">
<p class="kd-eyebrow">கோயம்புத்தூர் &amp; கோவை · மொழி &amp; பண்பாடு</p>
<p class="kd-lead">காந்திபுரம், ஆர்.எஸ். புரம் அல்லது பொள்ளாச்சி அருகிலுள்ள கிராமங்களில் பெரியவர்கள் பேசும் சில சொற்கள் பாடப்புத்தகத் தமிழில் இல்லாமல் இருக்கலாம். அது <strong>கொங்கு தமிழ்</strong> — மேற்கு தமிழ்நாட்டின் வாழும் வட்டார மொழி. MyCovai இந்த வட்டார அகராதியை எளிதாகக் கண்டுபிடித்து பதிவிறக்கம் செய்ய உதவுகிறது — தமிழ் மொழி, தமிழ் சமூகம், வட்டார மொழிகளுக்கு ஆதரவாக.</p>

<div class="kd-disclaimer">
<strong>பதிப்புரிமை &amp; ஒப்புதல்:</strong> இந்த அகராதி MyCovai-யின் வெளியீடு அல்ல. உரையின் அனைத்து உரிமைகளும் அசல் ஆசிரியர் மற்றும் வெளியீட்டாளருக்கே சொந்தம். MyCovai இந்த படைப்பின் உரிமையைக் கோருவதில்லை. தமிழ் மொழி, தமிழ் சமூகம், வட்டார மொழிகளுக்கு ஆதரவாக மட்டுமே பதிவிறக்க இணைப்பை வழங்குகிறோம். உரிமையாளர் நீங்கள் என்றால், இணைப்பை நீக்க அல்லது மாற்ற <a href="/contact.php">எங்களை தொடர்பு கொள்ளுங்கள்</a>.
</div>
<div class="kd-download-box">
<h2>பதிவிறக்கம்: கொங்கு வட்டாரச் சொல்லகராதி</h2>
<p><strong>கொங்கு வட்டாரச் சொல்லகராதி</strong> — கோயம்புத்தூர், ஈரோடு, திருப்பூர் மற்றும் கொங்கு பகுதி முழுவதும் பேசப்படும் வட்டாரச் சொற்களின் தொகுப்பு.</p>
<a class="kd-download-btn" href="{$pdfUrlEsc}" download target="_blank" rel="noopener">PDF பதிவிறக்கம் (இலவசம்)</a>
<p class="kd-download-meta">MyCovai சமூக வசதி &middot; PDF &middot; தமிழ் &middot; உரிமை ஆசிரியர் &amp; வெளியீட்டாளருக்கு</p>
</div>
<h2>கொங்கு தமிழ் என்றால் என்ன?</h2>
<p>கொங்கு தமிழ் (கோவை தமிழ், கொங்குப் பேச்சு, கொங்காளம்) என்பது கொங்கு நாடு — கோயம்புத்தூர் மையமாக — பேசப்படும் வட்டார மொழி. இது சென்னையில் பயன்படுத்தப்படும் சமநிலைத் தமிழிலிருந்து பல வழிகளில் வேறுபடுகிறது.</p>
<ul>
<li><strong>உச்சரிப்பு</strong> — பல கோவை பேச்சாளர்கள் ட/துக்கு பதிலாக ற ஒலியைப் பயன்படுத்துவர்.</li>
<li><strong>மரியாதை முடிவுகள்</strong> — வாங், வாஙொ போன்ற மரியாதை நிறைந்த அழைப்புகள்.</li>
<li><strong>விவசாயச் சொற்கள்</strong> — பயிர், கால்நடை, நெசவு தொடர்பான சொற்கள் இங்கே இன்னும் வாழ்ந்து வருகின்றன.</li>
<li><strong>அண்டை மொழி தாக்கம்</strong> — கன்னடம், மலையாளம் தொடர்புகள் பல சொற்களை விட்டுச் சென்றுள்ளன.</li>
</ul>
<h2>இந்த அகராதி பற்றி</h2>
<p>மேலே உள்ள PDF வட்டார அகராதி மரபைச் சேர்ந்தது. பெருமாள் முருகன் 1983-ல் ஈரோடில் மாணவராக சொற்களைச் சேகரிக்கத் தொடங்கி, 2000-ல் <em>கொங்கு வட்டாரச் சொல்லகராதி</em> வெளியிட்டார். இது பல்கலைக்கழக மொழி ஆய்வுகளில் கொங்கு பேச்சின் முக்கிய ஆவணமாகக் குறிப்பிடப்படுகிறது.</p>
<div class="kd-note"><strong>MyCovai ஏன் இதை வழங்குகிறது?</strong><br>நாங்கள் வெளியீட்டாளர் அல்ல; உள்ளூர் கோயம்புத்தூர் சமூகத் தளம். இந்த அகராதியைச் சுட்டிக்காட்டுவதன் மூலம் தமிழ் மொழி, தமிழ் சமூகம், கொங்கு வட்டாரம் ஆகியவற்றுக்கு ஆதரவளிக்க விரும்புகிறோம். மாணவர்கள், எழுத்தாளர்கள், பத்திரிகையாளர்கள், குடும்பங்கள் — பாட்டி/தாத்தா சொற்களை அடுத்த தலைமுறைக்கு கடத்த உதவும். மீண்டும் சொல்கிறோம்: பதிப்புரிமை மற்றும் புகழ் அசல் ஆசிரியர்/வெளியீட்டாளருக்கே; MyCovai-க்கு அல்ல.</div>
<h2>யாருக்கு பயன்?</h2>
<ul>
<li>தமிழ் மொழியியல், வட்டார இலக்கியம் படிக்கும் மாணவர்கள் &amp; ஆசிரியர்கள்</li>
<li>நமது கோவை உரையாடலுக்கு உண்மையான தன்மை வேண்டும் எழுத்தாளர்கள் &amp; பத்திரிகையாளர்கள்</li>
<li>குழந்தைகளுக்கு முதியவர் சொற்கள் புரிய வேண்டும் குடும்பங்கள்</li>
<li>கோவai-க்கு புதியவர்கள் — ஆட்டோ, Tea kadais-ல் கேட்கும் சொற்கள்</li>
</ul>
<p>மேலே உள்ள பொத்தானில் PDF பதிவிறக்கம் செய்து, கொங்கு நாட்டின் குரலை உங்கள் அலைபேசி அல்லது கணினியில் வைத்துக் கொள்ளுங்கள்.</p>
</div>
HTML;
}