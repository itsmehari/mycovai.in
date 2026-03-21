<?php
/**
 * Update the Vellalore waste-to-energy article with 2000+ word editorial content.
 * Connects to DB and runs UPDATE directly (no HTML file intermediary).
 *
 * Dry run (default): Shows what would be updated, does not write. No DB needed.
 * Live run: DB_HOST=mycovai.in php update-vellalore-article-live.php --confirm
 */
$root = dirname(__DIR__);
chdir($root);

$slug = 'tnpcb-urged-reject-waste-to-energy-vellalore-coimbatore-march-2026';
$summary = 'The Kurichi-Vellalore Pollution Prevention Action Committee has urged TNPCB not to approve the Coimbatore corporation\'s waste-to-energy plant at Vellalore dump yard, citing air pollution, groundwater contamination and odour issues.';

$content = <<<'HTML'
<p class="lead">The Kurichi-Vellalore Pollution Prevention Action Committee has urged the Tamil Nadu Pollution Control Board (TNPCB) not to approve the Coimbatore City Municipal Corporation's proposal to set up a waste-to-energy plant at the Vellalore dump yard. The committee cited existing environmental degradation in the area—air pollution, groundwater contamination, and odour—and argued that legacy waste must be cleared through bio-mining before any new facility is considered. This analysis examines the proposal, stakeholder positions, and implications for Coimbatore and the Kongu region.</p>

<h2>What Happened</h2>
<p>On March 19, 2026, the Kurichi-Vellalore Pollution Prevention Action Committee submitted a representation to the TNPCB urging it not to grant approval for a waste-to-energy (WtE) plant at the Vellalore dump yard. The Corporation has proposed the plant as part of its solid waste management strategy. The committee contended that the dump yard has already caused severe environmental harm to residents within a 10 km radius and that adding a WtE facility would compound the problem. The committee has asked TNPCB to reject the proposal until legacy waste is cleared and environmental compliance is demonstrated.</p>
<p>The Municipal Administration and Water Supply Department has invited tenders for a 1,200 tonnes-per-day (TPD) waste-to-energy facility at Vellalore to process municipal solid waste from Coimbatore and Tiruppur corporations. The project is envisaged under a design-build-finance-operate-transfer (DBFOT) model, with Coimbatore Corporation as the lead urban local body. The committee argues that the project is premature because legacy waste at the site has not been fully cleared through bio-mining, which it considers a mandatory precondition under the Solid Waste Management Rules, 2016.</p>
<p>TNPCB inspection reports have documented that the Coimbatore Corporation dumps approximately 300 tonnes of untreated municipal solid waste daily at Vellalore. The city generates 1,100–1,200 tonnes of waste per day; about 950 tonnes are processed, leaving 300 tonnes dumped untreated across 25 acres. The dump yard has been flagged for non-compliance with the Solid Waste Management Rules. The National Green Tribunal (NGT) has directed TNPCB to conduct monthly inspections of the site since June 2025, and the Central Pollution Control Board has also inspected the dump yard as directed by the NGT South Zone. The Vellalore site has been in use for decades and is one of the primary disposal points for Coimbatore's municipal solid waste. Residents in Kurichi, Vellalore, and nearby areas have long complained of odour, groundwater contamination, and air quality issues linked to the dump yard.</p>

<h2>Stakeholder Perspectives</h2>
<p>The Kurichi-Vellalore Pollution Prevention Action Committee represents residents and civic groups in the Kurichi and Vellalore areas. Its members have long raised concerns over air pollution, groundwater contamination, and odour emanating from the dump yard. The committee has argued that waste-to-energy plants are an unsuccessful model in India and pose public health risks by emitting toxic pollutants such as dioxins and furans when waste composition is not strictly controlled.</p>
<p>Corporation officials have maintained that the city needs a sustainable solution for its growing waste stream. Coimbatore, like many Indian cities, faces pressure to move away from open dumping and landfilling. Waste-to-energy is promoted under national policy as a way to recover energy from non-recyclable waste while reducing landfill burden. The Corporation's position is that a well-designed, compliant WtE plant can be part of an integrated solid waste management system.</p>
<p>Environmental experts are divided. Some point to successful WtE projects in Delhi and other cities where rigorous emission controls and waste segregation have been enforced. Others note that many Indian WtE plants have underperformed or faced litigation over emissions and ash disposal. The critical factors are waste quality (segregation at source), technology choice, and continuous monitoring. Without robust segregation, mixed waste fed into WtE plants can produce harmful emissions and low energy recovery.</p>
<p>Residents in Kurichi, Vellalore, and neighbouring localities have reported health issues and declining quality of life. Odour complaints are frequent, especially during summer and after rain. Groundwater in the area has been affected, and some residents rely on tanker water. The committee has demanded that legacy waste be cleared through bio-mining before any new facility is built, and that a comprehensive environmental impact assessment be placed in the public domain. Schools and healthcare facilities in the vicinity have also raised concerns about the impact of sustained pollution on children and vulnerable populations. The committee has cited studies and reports from other dump sites in India to support its argument that waste-to-energy plants, when poorly sited or operated, can worsen rather than improve local environmental conditions.</p>

<h2>Policy and Infrastructure Context</h2>
<p>The Solid Waste Management Rules, 2016 require urban local bodies to process waste in a scientific manner and phase out open dumping. The rules emphasise segregation at source, recycling, composting, and only then energy recovery or landfilling for rejects. Waste-to-energy is permitted but must comply with emission norms prescribed by the Central Pollution Control Board and state boards. TNPCB is the consenting authority for such projects in Tamil Nadu. Urban local bodies must also prepare solid waste management plans and ensure that processing facilities meet the standards laid down in the rules.</p>
<h3>Legacy Waste and Bio-mining</h3>
<p>Legacy waste refers to old waste accumulated at dump sites before modern processing was in place. Bio-mining involves excavating, segregating, and processing this waste to recover materials and stabilise the site. The NGT and courts have often directed that legacy waste be cleared before new facilities are commissioned. The committee's argument that bio-mining is a precondition aligns with this line of judicial and regulatory thinking. The Corporation's progress on bio-mining at Vellalore has been questioned in NGT proceedings. In several similar cases across India, courts have held that adding new processing capacity at a site with unresolved legacy waste and ongoing violations is not permissible until remediation is complete.</p>
<h3>Waste-to-Energy Technology</h3>
<p>Waste-to-energy typically uses incineration or similar thermal processes to convert combustible waste into electricity. The technology can reduce waste volume and generate power, but it requires consistent waste quality and strict emission control. Mixed municipal solid waste with high moisture and low calorific value is not ideal for WtE. The success of such plants depends heavily on upstream segregation and the quality of waste received. Plants in Delhi (Okhla, Ghazipur) and elsewhere have faced litigation over emissions; some have been asked to shut down or comply with stricter norms. The experience underscores the need for robust monitoring and for ensuring that only suitable waste is fed into such facilities.</p>
<h3>Tamil Nadu and Kongu Region Context</h3>
<p>Coimbatore and Tiruppur are major industrial and urban centres in the Kongu region. Both generate substantial municipal solid waste. The proposed 1,200 TPD plant would serve both corporations, reflecting a move toward regional waste management. Similar proposals have been floated for other districts. The outcome at Vellalore will be watched by other urban local bodies considering waste-to-energy as part of their waste management strategy.</p>

<h2>Local Impact</h2>
<h3>Short-Term Effects</h3>
<p>If TNPCB withholds consent, the Corporation's tender process for the WtE plant would be stalled. The city would need to rely on existing processing capacity and continue to address the 300 tonnes of daily untreated dumping through other means. Alternatives could include accelerating bio-mining, expanding composting or bio-methanation facilities, or improving segregation so that less mixed waste reaches the dump yard. If consent is granted, construction would add another phase of activity at Vellalore—potentially increasing traffic, dust, and noise during the build-out period. Residents in the vicinity would experience extended disruption. The tender envisages a DBFOT model, so the selected private operator would be responsible for design, construction, and operation over the concession period.</p>
<h3>Medium-Term Outlook</h3>
<p>A commissioned WtE plant could reduce the quantum of waste going to the dump yard and potentially generate electricity for the grid. However, if legacy waste remains and segregation at source does not improve, the plant may operate below design capacity or with suboptimal waste quality. Emission compliance would need to be rigorously monitored. The committee and residents would likely continue to press for remediation of existing pollution and transparency in monitoring data.</p>
<p>The issue also has broader implications for Coimbatore's solid waste management strategy. The city must balance the need for disposal capacity with environmental protection and community concerns. Similar debates have played out at Perungudi and Kodungaiyur in Chennai, and at other dump sites across India. The outcome at Vellalore could influence how other cities in the Kongu region approach waste-to-energy proposals. Success in addressing legacy waste and improving segregation would strengthen the case for any future WtE or similar facility. Conversely, continued non-compliance could lead to further NGT directions, penalties, or restrictions on dumping.</p>

<h2>What to Watch Next</h2>
<p>TNPCB's decision on the consent application will be the immediate milestone. The committee's representation will be part of the record. Residents can track updates through TNPCB's online consent management system and through local news. The NGT's ongoing oversight of the Vellalore dump yard—including monthly inspection reports—remains in force. Any significant non-compliance could trigger further directions.</p>
<p>The Corporation may need to demonstrate progress on legacy waste clearance and compliance with SWM Rules before TNPCB is willing to grant consent for a new facility. Stakeholders on both sides are likely to await the next NGT hearing or TNPCB order for clarity on the way forward. If the tender process proceeds, the selection of a technology provider and the terms of the DBFOT agreement will also be of interest. Environmental groups and residents may seek to intervene in consent proceedings or approach the NGT if they believe due process has not been followed.</p>

<h2>Frequently Asked Questions</h2>
<h3>What is the Kurichi-Vellalore Pollution Prevention Action Committee?</h3>
<p>It is a civic group representing residents and stakeholders in the Kurichi and Vellalore areas of Coimbatore. The committee has been vocal about environmental degradation from the Vellalore dump yard and has opposed the waste-to-energy plant proposal. It submitted its representation to TNPCB on March 19, 2026, urging the board not to approve the Corporation's proposal. The committee has called for bio-mining of legacy waste, transparency in environmental assessments, and compliance with Solid Waste Management Rules before any new facility is considered.</p>
<h3>What does TNPCB's consent mean for the waste-to-energy plant?</h3>
<p>TNPCB grants consent to establish (CTE) and consent to operate (CTO) under the Water (Prevention and Control of Pollution) Act and the Air (Prevention and Control of Pollution) Act. Without TNPCB approval, the plant cannot be built or operated. The committee has asked TNPCB not to approve the proposal. TNPCB considers representations from the public and other stakeholders as part of its consent process.</p>
<h3>Why does the committee want bio-mining before a WtE plant?</h3>
<p>The committee argues that legacy waste at Vellalore must be cleared through bio-mining first, as required under Solid Waste Management Rules and as often directed by courts. It contends that adding a new facility on a site with unresolved legacy waste and ongoing compliance issues would worsen the situation.</p>
<h3>How much waste does Coimbatore generate, and what happens to it?</h3>
<p>Coimbatore generates about 1,100–1,200 tonnes of municipal solid waste per day. Approximately 950 tonnes are processed; around 300 tonnes are dumped untreated at Vellalore. The proposed WtE plant would have a capacity of 1,200 TPD and would also receive waste from Tiruppur.</p>
<h3>Who should residents contact for complaints or information?</h3>
<p>Residents can approach TNPCB regional office in Coimbatore, the Coimbatore Corporation's solid waste management wing, or the District Environmental Engineer. NGT-related matters can be raised through the tribunal's online portal or via legal representation. The Kurichi-Vellalore Pollution Prevention Action Committee may also be a point of contact for residents wishing to join or support the representation. Pollution complaints can be lodged through the TNPCB grievance mechanism or the CPCB pollution-related portals.</p>
<h3>What is the status of the tender for the waste-to-energy plant?</h3>
<p>The Municipal Administration and Water Supply Department has floated tenders for the 1,200 TPD facility. The project is to be implemented under a DBFOT model with Coimbatore Corporation as the lead urban local body. Whether the tender process can proceed depends on land availability, environmental clearances, and TNPCB consent. The committee's opposition and the NGT's oversight add layers of scrutiny that may affect the timeline. Tiruppur Corporation is also a beneficiary of the proposed plant, which would process waste from both cities.</p>
HTML;

$confirm = in_array('--confirm', $argv ?? []);
$isLive = (getenv('DB_HOST') ?: '') === 'mycovai.in' || (isset($_SERVER['DB_HOST']) && $_SERVER['DB_HOST'] === 'mycovai.in');
$wordCount = str_word_count(strip_tags($content));

if (!$confirm) {
    echo "Dry run. Would UPDATE articles for slug: $slug\n";
    echo "Word count: $wordCount\n";
    echo "To execute on live: DB_HOST=mycovai.in php " . basename(__FILE__) . " --confirm\n";
    exit(0);
}

require_once $root . '/core/omr-connect.php';
$stmt = $conn->prepare("UPDATE articles SET content = ?, summary = ?, updated_at = NOW() WHERE slug = ?");
if (!$stmt) {
    fwrite(STDERR, "Prepare failed: " . $conn->error . "\n");
    exit(1);
}
$stmt->bind_param("sss", $content, $summary, $slug);
$stmt->execute();
$affected = $stmt->affected_rows;
$stmt->close();
$conn->close();

echo "Updated: $affected row(s) for slug: $slug\n";
if ($affected > 0) {
    echo "Test at: https://mycovai.in/local-news/" . $slug . "\n";
}
