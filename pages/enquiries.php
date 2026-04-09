<?php
require_once '../core/Auth.php';
require_once '../core/Database.php';

$auth = new Auth();

if (!$auth->check()) {
    header("Location: ../index.php");
    exit;
}

// DB setup
$db = new Database();
$db->connect();

// fetch data
$result = $db->getEnquiries();
?>

<?php include('../layout/header.php'); ?>
<?php include('../layout/navbar.php'); ?>
<?php include('../layout/sidebar.php'); ?>

<h2 class="mb-4">Enquiries</h2>

<div class="table-responsive">
<table id="enquiryTable" class="table table-bordered table-striped">

    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Message</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php if ($result && $result->num_rows > 0): ?>
        <?php $i = 1; ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone'] ?? '-') ?></td>
                <td><?= htmlspecialchars($row['message'] ?? '-') ?></td>
                <td><?= date('d-m-Y H:i', strtotime($row['created_at'])) ?></td>
                <td>
                    <button class="btn btn-sm btn-info viewBtn"
                        data-name="<?= htmlspecialchars($row['name']) ?>"
                        data-email="<?= htmlspecialchars($row['email']) ?>"
                        data-phone="<?= htmlspecialchars($row['phone'] ?? '-') ?>"
                        data-message="<?= htmlspecialchars($row['message'] ?? '-') ?>"
                    >
                        View
                    </button>

                    <a href="../actions/delete_enquiry.php?id=<?= $row['id'] ?>"
                    onclick="return confirm('Delete this enquiry?')"
                    class="btn btn-sm btn-danger">
                    Delete
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php //else: ?>
        <!-- <tr>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>No data found</td>
            <td>-</td>
            <td>-</td>
        </tr> -->
    <?php endif; ?>

    </tbody>
</table>
</div>
<div class="modal fade" id="viewModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Enquiry Details</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p><strong>Name:</strong> <span id="m_name"></span></p>
        <p><strong>Email:</strong> <span id="m_email"></span></p>
        <p><strong>Phone:</strong> <span id="m_phone"></span></p>
        <p><strong>Message:</strong> <span id="m_message"></span></p>
      </div>

    </div>
  </div>
</div>
<?php include('../layout/footer.php'); ?>
<script>
$(document).ready(function() {
    // $('#enquiryTable').DataTable({
    //     dom: 'Bfrtip',
    //     buttons: ['copy', 'excel', 'csv', 'pdf', 'print']
    // });
    $('#enquiryTable').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
        language: {
            emptyTable: "No enquiries found"
        }
    });
});
</script>
<script>
$(document).on('click', '.viewBtn', function() {
    $('#m_name').text($(this).data('name'));
    $('#m_email').text($(this).data('email'));
    $('#m_phone').text($(this).data('phone'));
    $('#m_message').text($(this).data('message'));

    var modal = new bootstrap.Modal(document.getElementById('viewModal'));
    modal.show();
});
</script>

<?php include('../layout/footer-close.php'); ?>

