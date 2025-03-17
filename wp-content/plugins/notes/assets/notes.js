document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.notes-form');
    if (!form) return;
  
    form.addEventListener('submit', function (e) {
      e.preventDefault();
  
      // GET FORM FIELDS DATA
      const user = form.querySelector('input[name="user"]').value;
      const action_type = form.querySelector('input[name="action"]').value;
      const note = form.querySelector('input[name="note"]').value;
      const title = form.querySelector('input[name="notes_title"]').value.trim();
      const content = tinyMCE.get('notes_content') ? tinyMCE.get('notes_content').getContent() : form.querySelector('textarea[name="notes_content"]').value.trim();
  
      const errorHandler = form.querySelector('.error-handler');
      errorHandler.innerHTML = '';
  
      // VALIDATION
      if (!title || !content) {
        errorHandler.innerHTML = '<p>Please fill in both Title and Content fields.</p>';
        return;
      }
  
      // FORM DATA
      const formData = new FormData();
      formData.append('action', 'notes');
      formData.append('security', window.notes_ajax.nonce);
      formData.append('user', user);
      formData.append('action_type', action_type);
      formData.append('note', note);
      formData.append('title', title);
      formData.append('content', content);
  
      // SEND AJAX REQUEST
      fetch(window.notes_ajax.ajax_url, {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          errorHandler.innerHTML = `<p style="color:green;">${data.message}</p>`;
          form.reset();
          if (tinyMCE.get('notes_content')) {
            tinyMCE.get('notes_content').setContent('');
          }
        } else {
          errorHandler.innerHTML = `<p style="color:red;">${data.message}</p>`;
        }
      })
      .catch(error => {
        console.error('Error:', error);
        errorHandler.innerHTML = `<p style="color:red;">Something went wrong. Please try again later.</p>`;
      });
    });
  });
  