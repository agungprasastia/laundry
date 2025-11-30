const loginForm = document.getElementById('login-form');

if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const user = document.getElementById('username').value;
        const pass = document.getElementById('password').value;
        const errorMsg = document.getElementById('error-msg');
        
        if (user === 'admin' && pass === 'admin123') {
            alert("Login Berhasil!");
            window.location.href = "dashboard.html";
        } else {
            errorMsg.style.display = 'block';
        }
    });
}

const laundryForm = document.getElementById('laundry-form');
const laundryTable = document.getElementById('laundry-table')?.getElementsByTagName('tbody')[0];

if (laundryForm && laundryTable) {
    laundryForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const nama = document.getElementById('nama-paket').value;
        const harga = document.getElementById('harga-paket').value;
        const estimasi = document.getElementById('estimasi-waktu').value;
        const gambar = document.getElementById('gambar-paket').files[0];

        if (nama && harga) {
            const row = laundryTable.insertRow();
            
            row.insertCell(0).innerText = laundryTable.rows.length;
            row.insertCell(1).innerText = nama;
            row.insertCell(2).innerText = "Rp " + harga;
            row.insertCell(3).innerText = estimasi;
            
            const cellImg = row.insertCell(4);
            if(gambar){
                const reader = new FileReader();
                reader.onload = function(e){ 
                    cellImg.innerHTML = `<img src="${e.target.result}" width="50" style="border-radius:4px;">`; 
                }
                reader.readAsDataURL(gambar);
            } else {
                cellImg.innerText = "No Image";
            }

            row.insertCell(5).innerHTML = `<button class="btn-small red" onclick="hapusBaris(this)">Hapus</button>`;
            
            laundryForm.reset();
            alert("Data Paket Berhasil Disimpan!");
        }
    });
}

function hapusBaris(button) {
    if(confirm("Hapus paket ini?")) {
        const row = button.parentElement.parentElement;
        row.remove();
        
        if (laundryTable) {
            const rows = laundryTable.rows;
            for (let i = 0; i < rows.length; i++) {
                rows[i].cells[0].innerText = i + 1;
            }
        }
    }
}