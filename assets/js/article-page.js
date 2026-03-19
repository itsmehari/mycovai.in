/**
 * Article page interactivity: copy link, native share, sticky share bar, back-to-top, progress bar
 */
(function() {
  'use strict';

  const articleUrl = typeof ARTICLE_URL !== 'undefined' ? ARTICLE_URL : (window.location.href || '');
  const articleTitle = typeof ARTICLE_TITLE !== 'undefined' ? ARTICLE_TITLE : document.title;

  // Copy link button
  const copyBtn = document.getElementById('article-copy-link-btn');
  if (copyBtn) {
    copyBtn.addEventListener('click', function() {
      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(articleUrl).then(function() {
          showToast('Link copied!');
          copyBtn.querySelector('i').className = 'fas fa-check';
          setTimeout(function() {
            copyBtn.querySelector('i').className = 'fas fa-link';
          }, 2000);
        }).catch(function() {
          fallbackCopy();
        });
      } else {
        fallbackCopy();
      }
    });
  }

  function fallbackCopy() {
    const ta = document.createElement('textarea');
    ta.value = articleUrl;
    ta.style.position = 'fixed';
    ta.style.left = '-9999px';
    document.body.appendChild(ta);
    ta.select();
    try {
      document.execCommand('copy');
      showToast('Link copied!');
    } catch (e) {
      showToast('Could not copy. Please copy the URL manually.');
    }
    document.body.removeChild(ta);
  }

  function showToast(msg) {
    let toast = document.getElementById('article-toast');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'article-toast';
      toast.style.cssText = 'position:fixed;bottom:20px;left:50%;transform:translateX(-50%);background:#14532d;color:#fff;padding:0.75rem 1.5rem;border-radius:8px;font-size:0.9rem;z-index:9999;opacity:0;transition:opacity 0.3s;pointer-events:none;';
      document.body.appendChild(toast);
    }
    toast.textContent = msg;
    toast.style.opacity = '1';
    setTimeout(function() {
      toast.style.opacity = '0';
    }, 2500);
  }

  // Native Web Share API
  const nativeShareBtn = document.getElementById('article-native-share-btn');
  if (nativeShareBtn && navigator.share) {
    nativeShareBtn.style.display = 'inline-flex';
    nativeShareBtn.addEventListener('click', function() {
      navigator.share({
        title: articleTitle,
        url: articleUrl,
        text: articleTitle
      }).then(function() {
        showToast('Shared!');
      }).catch(function() {});
    });
  }

  // Save as PDF - trigger print dialog
  const pdfBtn = document.getElementById('article-save-pdf-btn');
  if (pdfBtn) {
    pdfBtn.addEventListener('click', function(e) {
      e.preventDefault();
      window.print();
    });
  }

  // Sticky share bar
  const shareSection = document.querySelector('.article-share-section');
  let stickyShareBar = null;
  let shareSectionTop = 0;

  function initStickyShare() {
    if (!shareSection) return;
    const buttons = shareSection.querySelector('.article-share-buttons');
    if (!buttons) return;

    stickyShareBar = document.createElement('div');
    stickyShareBar.className = 'article-share-sticky';
    buttons.querySelectorAll('a.article-share-btn').forEach(function(a) {
      var clone = a.cloneNode(true);
      clone.setAttribute('target', '_blank');
      clone.setAttribute('rel', 'noopener noreferrer');
      stickyShareBar.appendChild(clone);
    });
    document.body.appendChild(stickyShareBar);
    shareSectionTop = shareSection.getBoundingClientRect().top + window.pageYOffset;
  }

  function onScroll() {
    if (!stickyShareBar) return;
    const scrollY = window.pageYOffset || document.documentElement.scrollTop;
    const windowH = window.innerHeight;
    if (scrollY > shareSectionTop + 200 && scrollY < document.body.scrollHeight - windowH - 150) {
      stickyShareBar.classList.add('is-visible');
    } else {
      stickyShareBar.classList.remove('is-visible');
    }
  }

  if (shareSection && window.innerWidth <= 768) {
    initStickyShare();
    window.addEventListener('scroll', function() {
      requestAnimationFrame(onScroll);
    }, { passive: true });
  }

  // Back to top
  const backToTop = document.getElementById('article-back-to-top');
  if (backToTop) {
    window.addEventListener('scroll', function() {
      const scrollY = window.pageYOffset || document.documentElement.scrollTop;
      if (scrollY > 400) {
        backToTop.classList.add('is-visible');
      } else {
        backToTop.classList.remove('is-visible');
      }
    }, { passive: true });
    backToTop.addEventListener('click', function() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // Progress bar
  const progressBar = document.getElementById('article-progress-bar');
  if (progressBar) {
    window.addEventListener('scroll', function() {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      const pct = docHeight > 0 ? Math.min(100, (scrollTop / docHeight) * 100) : 0;
      progressBar.style.width = pct + '%';
    }, { passive: true });
  }

  // Add IDs to h2/h3 for ToC links
  document.querySelectorAll('.article-content h2, .article-content h3').forEach(function(el, idx) {
    if (!el.id) {
      el.id = 'section-' + (idx + 1);
    }
  });
})();
