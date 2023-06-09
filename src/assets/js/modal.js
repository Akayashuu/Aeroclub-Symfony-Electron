import $ from "jquery";
document.addEventListener('DOMContentLoaded', () => {
    // Functions to open and close a modal
    function openModal($el) {
      $el.classList.add('is-active');
    }
  
    function closeModal($el) {
      $el.classList.remove('is-active');
    }
  
    function closeAllModals() {
      (document.querySelectorAll('.modal') || []).forEach(($modal) => {
        closeModal($modal);
      });
    }
  
    // Add a click event on buttons to open a specific modal
  (document.querySelectorAll('#js-modal-trigger') || []).forEach(($trigger) => {
      const modal = $trigger.dataset.target;
      const $target = document.getElementById(modal);
  
      $trigger.addEventListener('click', () => {
        openModal($target);
      });
    });
  
    // Add a click event on various child elements to close the parent modal
    (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
      const $target = $close.closest('.modal');
  
      $close.addEventListener('click', () => {
        closeModal($target);
      });
    });
  
    // Add a keyboard event to close all modals
    document.addEventListener('keydown', (event) => {
      const e = event || window.event;
  
      if (e.key === "Enter") { // Escape key
        closeAllModals();
      }
    });
  });

$(document).ready(function() {
    $('#confirm-delete-modal-button').on('click', function() {
        var form = $(this).closest('.modal').data('form');
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function() {
                window.location.reload();
            }
        });
    });
});

$(document).on('click', '[data-modal-target]', function() {
    var modalId = $(this).data('modal-target');
    var form = $(this).closest('form');
    $('#' + modalId).addClass('is-active').data('form', form);
    return false;
});

$(document).on('click', '.modal-close, .modal-background', function() {
    $(this).closest('.modal').removeClass('is-active');
    return false;
});
