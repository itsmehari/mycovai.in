// MyCovai Events - Google Analytics event helpers
(function () {
  function pushEvent(name, params) {
    if (typeof gtag === 'function') {
      gtag('event', name, params || {});
    }
  }

  window.MyCovaiEventsAnalytics = {
    filterUsed: function (label) { pushEvent('events_filter_used', { filter: label }); },
    eventView: function (slug) { pushEvent('events_event_view', { event_slug: slug }); },
    shareClicked: function (channel, slug) { pushEvent('events_share_click', { channel: channel, event_slug: slug }); },
    mapClicked: function (slug) { pushEvent('events_map_click', { event_slug: slug }); },
    ticketClicked: function (slug) { pushEvent('events_ticket_click', { event_slug: slug }); },
    submissionStart: function () { pushEvent('events_post_start'); },
    submissionSubmit: function () { pushEvent('events_post_submit'); },
    submissionSuccess: function (id) { pushEvent('events_post_success', { submission_id: id }); }
  };

  document.addEventListener('DOMContentLoaded', function () {
    var q = document.querySelector('[data-events-filter]');
    if (q) {
      q.addEventListener('change', function () {
        window.MyCovaiEventsAnalytics.filterUsed(q.value || 'all');
      });
    }
  });
})();
