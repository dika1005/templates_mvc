const form = document.getElementById('adminForm');
const tableBody = document.querySelector('#dataTable tbody');
let editIndex = -1;

form.addEventListener('submit', function (e) {
  e.preventDefault();

  const nik = document.getElementById('nik').value;
  const nama = document.getElementById('nama').value;
  const umur = document.getElementById('umur').value;
  const alamat = document.getElementById('alamat').value;

  if (editIndex === -1) {
    addRow(nik, nama, umur, alamat);
  } else {
    updateRow(editIndex, nik, nama, umur, alamat);
    editIndex = -1;
    form.querySelector('input[type="submit"]').value = 'Tambah Data';
  }

  form.reset();
});

function addRow(nik, nama, umur, alamat) {
  const row = tableBody.insertRow();

  row.innerHTML = `
    <td>${nik}</td>
    <td>${nama}</td>
    <td>${umur}</td>
    <td>${alamat}</td>
    <td>
      <button onclick="editRow(this)">Edit</button>
      <button onclick="deleteRow(this)">Hapus</button>
    </td>
  `;
}

function editRow(button) {
  const row = button.parentElement.parentElement;
  editIndex = row.rowIndex - 1;

  document.getElementById('nik').value = row.cells[0].innerHTML;
  document.getElementById('nama').value = row.cells[1].innerHTML;
  document.getElementById('umur').value = row.cells[2].innerHTML;
  document.getElementById('alamat').value = row.cells[3].innerHTML;

  form.querySelector('input[type="submit"]').value = 'Update Data';
}

function deleteRow(button) {
  const row = button.parentElement.parentElement;
  tableBody.deleteRow(row.rowIndex - 1);
}
