<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-modal">
        <div class="modal-header">
          <h5 class="modal-title" id="notificationModalLabel">
            <img src="{{ config('static.url_portal_ts3_main') }}img/logo/logo.png" alt="Notification Image" style="width: 150px; height: auto;">
        </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="notification-modal-body">
          <!-- Notifikasi detail akan ditampilkan di sini -->
        </div>

      </div>
    </div>
  </div>
  <style>
    .rounded-modal {
        border-radius: 20px;
    }
  </style>