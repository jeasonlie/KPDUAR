@extends('layout.layout')
@section('title', 'Barang Masuk')
@section('content')

<div class="title">Barang Masuk</div>
<br>
<div class="input">
    <form action="{{route('barangmasuk.store')}}" method="POST">
    @csrf
        @if (session()->has('message'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('message') }}
        </div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('error') }}
        </div>
        @endif
        <br><br>
        <label>Tanggal</label>
        <input type="date" name="tanggal_masuk" required style="margin-bottom:10px">
        <table id="input-barang">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Keterangan</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="id_barang[]" required onchange="addBarangToArray(this)">
                            <option value="">Pilih Barang</option>
                            @foreach ($barang as $value)
                                <option value="{{$value->id}}">{{$value->nama_barang}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="jumlah_barang[]" min="1" required>
                    </td>
                    <td>
                        <input type="text" name="keterangan_masuk[]">
                    </td>
                    <td>
                        {{-- untuk menghapus tr dengan menggunakan parameter this --}}
                        <button onclick="hapusRow(this)" type="button" class="btn-remove-row">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="tombol" style="margin-top:10px">
            <button type="button" onclick="tambahRow()">Tambah List</button>
            <button type="submit">Simpan</button>
        </div>
    </form>
</div>
<br><br><br>
<table id="isiTabel">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Total Barang</th>
            <th>Diinput Oleh</th>
            <th>Detail</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($barangmasuk as $value)
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->tanggal_masuk}}</td>
                <td>{{count($value->barangmasukdetail)}}</td>
                <td>{{$value->User->name}}</td>
                <td><a href="{{route('barangmasuk.show', ['id' => $value->id])}}">
                    <div class="detail">
                        Detail
                    </div>
                </a></td>
                <td><a href="{{route('barang.edit', ['id' => $value->id])}}">
                    <div class="edit">
                        Edit
                    </div>
                </a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    let barang = [];
        // get barang data dari php ke js
        let barangData = <?php echo json_encode($barang); ?>;

        let count = 2;

        // utk hapus row
        function hapusRow(evt) {
            count--;

            let indexToRemove = barang.indexOf(+evt.closest('tr').querySelector('select[name="id_barang[]"]').value);

            if (indexToRemove !== -1) {
                // Remove the element using splice
                barang.splice(indexToRemove, 1);
            }

            //mengambil tr terdekat dengan method closest
            //rmove untuk menghapus element
            //evt adalah tombol yang di klik
            // console.log('evt') // uncomment utk melihat
            // utk melihat hasil tr terdekat
            // console.log('evt.closest('tr')') // uncomment utk melihat
            evt.closest('tr').remove();
            renderAllSelect();
        }
        addBarangToArray(document.querySelector('select[name="id_barang[]"]'));

        function addBarangToArray(evt) {
            let previousValue = evt.getAttribute('data-previous-value');

            if (previousValue) {
                let indexToRemove = barang.indexOf(+previousValue);
                if (indexToRemove !== -1) {
                    barang.splice(indexToRemove, 1);
                }
            }

            evt.setAttribute('data-previous-value', evt.value);

            barang.push(+evt.value);
            renderAllSelect(); 
        }

        function renderAllSelect() {
            let select = document.querySelectorAll('select[name="id_barang[]"]');
            select.forEach(selectElement => {
                let options = "";
                options += `<option value="">Pilih Barang</option>`;
                barangData.filter(item=> !barang.includes(item.id)).forEach(item => {
                    options += `<option value="${item.id}">${item.nama_barang}</option>`
                });
                if (selectElement.value !== '') {
                    options +=`<option value="${selectElement.value}" selected>${selectElement.options[selectElement.selectedIndex].text}</option>`
                }
                selectElement.innerHTML = options;

            });
        }

        // utk tambah row
        function tambahRow() {
            // menselect tabel dengan id input-barang
            const tabel = document.querySelector('#input-barang tbody');
            // isi HTML yang ingin di tambah
            let row = `
                <tr>
                    <td>
                        <select name="id_barang[]" required onchange="addBarangToArray(this)">
                            <option value="">Pilih Barang</option>
                            @foreach ($barang as $value)
                                <option value="{{$value->id}}">{{$value->nama_barang}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="jumlah_barang[]" min="1" required>
                    </td>
                    <td>
                        <input type="text" name="keterangan_masuk[]">
                    </td>
                    <td>
                        <button onclick="hapusRow(this)" type="button" class="btn-remove-row">Hapus</button>
                    </td>
                </tr>
            `;
            // melakukan insert row dari data di atas
            if (count <= barangData.length) {
                tabel.insertAdjacentHTML('beforeend', row);
                count++;
            }
            renderAllSelect();
        }
        renderAllSelect();
</script>
@endsection