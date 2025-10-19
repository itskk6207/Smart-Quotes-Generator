// assets/js/app.js
document.addEventListener('DOMContentLoaded', () => {
  const nextBtn = document.getElementById('nextBtn');
  const quoteText = document.getElementById('quoteText');
  const quoteAuthor = document.getElementById('quoteAuthor');
  const quoteCategory = document.getElementById('quoteCategory');

  if (nextBtn) {
    nextBtn.addEventListener('click', async () => {
      try {
        const resp = await fetch('api/random.php', { cache: 'no-store' });
        const data = await resp.json();
        if (data.ok) {
          quoteText.textContent = `“${data.data.quote_text}”`;
          quoteAuthor.textContent = `— ${data.data.author}`;
          quoteCategory.textContent = data.data.category || 'General';
        } else {
          alert(data.error || 'No quotes available');
        }
      } catch (e) {
        alert('Failed to fetch new quote.');
      }
    });
  }
});
