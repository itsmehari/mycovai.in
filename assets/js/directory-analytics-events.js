/**
 * Directory hub + active-filter chips → Google Analytics (gtag), when loaded after analytics.php.
 */
(function () {
  function fire(name, params) {
    if (typeof gtag !== 'function') return;
    gtag('event', name, params || {});
  }

  document.addEventListener('DOMContentLoaded', function () {
    var hubForm = document.querySelector('form[action="/directory/index.php"][method="get"][role="search"]');
    if (hubForm) {
      hubForm.addEventListener('submit', function () {
        var qEl = document.getElementById('hub-q');
        var locEl = document.getElementById('hub-location');
        var catEl = document.getElementById('hub-category');
        var q = qEl ? String(qEl.value || '').trim().slice(0, 120) : '';
        var loc = locEl ? String(locEl.value || '').trim() : '';
        var cat = catEl ? String(catEl.value || '').trim() : '';
        fire('directory_hub_search', {
          event_category: 'Directory',
          search_term: q,
          has_area: loc ? 'yes' : 'no',
          category_slug: cat || 'all',
        });
      });
    }

    document.body.addEventListener('click', function (e) {
      var dismiss = e.target.closest('.covai-active-filters a[aria-label^="Remove"]');
      if (dismiss) {
        var label = dismiss.getAttribute('aria-label') || '';
        var kind = /keyword/i.test(label) ? 'keywords' : /area/i.test(label) ? 'area' : 'filter';
        fire('directory_filter_dismiss', {
          event_category: 'Directory',
          event_label: kind,
        });
        return;
      }
      var clearAll = e.target.closest('.covai-active-filters a.btn');
      if (clearAll && /clear\s*all/i.test(String(clearAll.textContent || ''))) {
        fire('directory_filter_clear_all', { event_category: 'Directory' });
      }
    });
  });
})();
