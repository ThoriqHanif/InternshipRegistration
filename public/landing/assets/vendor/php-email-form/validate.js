(function () {
  "use strict";

  let forms = document.querySelectorAll('.php-email-form');
  let forms_unsubscribe = document.querySelectorAll('.php-email-form-unsubscribe');

  forms.forEach(function (form) {
    form.addEventListener('submit', function (event) {
      event.preventDefault();

      let thisForm = this;

      let action = thisForm.getAttribute('action');

      if (!action) {
        displayError(thisForm, 'The form action property is not set!');
        return;
      }

      thisForm.querySelector('.loading').classList.add('d-block');
      thisForm.querySelector('.error-message').classList.remove('d-block');
      thisForm.querySelector('.sent-message').classList.remove('d-block');

      let formData = new FormData(thisForm);

      php_email_form_submit(thisForm, action, formData);
    });
  });

  forms_unsubscribe.forEach(function (form) {
    form.addEventListener('submit', function (event) {
      event.preventDefault();

      let thisForm = this;

      let action = thisForm.getAttribute('action');

      if (!action) {
        displayError(thisForm, 'The form action property is not set!');
        return;
      }

      thisForm.querySelector('.loading').classList.add('d-block');
      thisForm.querySelector('.error-message').classList.remove('d-block');
      thisForm.querySelector('.sent-message').classList.remove('d-block');

      let formData = new FormData(thisForm);

      php_email_form_unsubscribe_submit(thisForm, action, formData);
    });
  });

  function php_email_form_submit(thisForm, action, formData) {
    fetch(action, {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    })
      .then(response => response.json()) // Respons JSON dari backend
      .then(data => {
        thisForm.querySelector('.loading').classList.remove('d-block');
        if (data.success) {
          thisForm.querySelector('.sent-message').classList.add('d-block');
          thisForm.querySelector('.sent-message').innerHTML = data.message;
          thisForm.reset();
        } else {
          throw new Error(data.message);
        }
      })
      .catch((error) => {
        displayError(thisForm, error.message);
      });
  }
  function php_email_form_unsubscribe_submit(thisForm, action, formData) {
    fetch(action, {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    })
      .then(response => response.json()) // Respons JSON dari backend
      .then(data => {
        thisForm.querySelector('.loading').classList.remove('d-block');
        if (data.success) {
          thisForm.querySelector('.newsletter-form-unsubscribe').style.display = 'none';
          thisForm.querySelector('.sent-message').classList.add('d-block');
          thisForm.querySelector('.sent-message').innerHTML = data.message;
          thisForm.reset();
        } else {
          throw new Error(data.message);
        }
      })
      .catch((error) => {
        displayError(thisForm, error.message);
      });
  }

  function displayError(thisForm, error) {
    thisForm.querySelector('.loading').classList.remove('d-block');
    thisForm.querySelector('.error-message').innerHTML = error;
    thisForm.querySelector('.error-message').classList.add('d-block');
  }

})();
