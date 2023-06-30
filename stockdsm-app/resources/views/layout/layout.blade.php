<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables.css')}}">
    <link rel="stylesheet" href="{{asset('css/modal.css')}}">
    <script src="{{asset('js/jquery-3.7.0.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.js')}}"></script>
    <script src="{{asset('js/datatables.min.js')}}"></script>
    <script src="{{asset('js/datatables.js')}}"></script>
    <title>@yield('title')</title>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="{{asset('logo.png')}}" alt="">
            <div class="sidebar-namaperusahaan">
                PT. Dewa Sukses Mandiri
            </div>
        </div>
        <div class="sidebar-menu">
            <div class="menu"><a href="/dashboard">Dashboard</a></div>
            <div class="menu"><a href="/user">User</a></div>
            <div class="menu"><a href="/barang">Barang</a></div>
            <div class="menu"><a href="/barangmasuk">Barang Masuk</a></div>
            <div class="menu"><a href="/barangkeluar">Barang Keluar</a></div>
        </div>
        <div class="sidebar-user">
            <div class="nama" style="color: #FFFFFF">
                {{Auth::user()->name}}
            </div>
            <div onclick="modal_logout('{{ route('logout') }}')" style="cursor:pointer; color:#FFFFFF">
                <img src="{{asset('logout.svg')}}" alt="">
                Logout
            </div>
        </div>
    </div>
    <div class="content">
        <div class="modal hidden">

        </div>
        @yield("content")
    </div>
</body>
<script>
    $(document).ready( function () {
        $('#isiTabel').dataTable({
            autoWidth: false,
            compact: true,
            scrollX: true,
            searching: true
        });
    });
    $(document).ready( function () {
        $('#input-barang').dataTable({
            autoWidth: false,
            compact: true,
            scrollX: true,
            searching: false, 
            paging: false, 
            info: false
        });
    });
    function modalLogoutToggle() {
        const modal = document.querySelector('.modal');
        modal.classList.toggle('hidden');
    }
    function modal_delete(title,id,link) {
        const modal = document.querySelector('.modal');
        modal.classList.toggle('hidden');
        modal.innerHTML = `
            <div class="modal-content" style="gap: 8px;">
                <h2>Delete ${title}</h2>
                <p>Apakah anda yakin ingin menghapus ${title} ini?</p>
                <div class="button flex-row" style="padding-top:10px; gap:10px">
                    <form action="${link}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn" value="Hapus">
                    </form>
                    <button class="clickable btn" id="batal" onclick="modalLogoutToggle()">Batal</button>
                </div>
            </div>
        `;
    }
    function modal_logout(link) {
        const modal = document.querySelector('.modal');
        modal.classList.toggle('hidden');
        modal.innerHTML = `
            <div class="modal-content" style="gap: 8px;">
                <h2>Logout</h2>
                <p>Apakah anda yakin ingin logout?</p>
                <div class="button flex-row" style="padding-top:10px; gap:10px">
                    <form id="keluar" method="POST" action="${link}">
                        @csrf
                        <button class="btn" onclick="event.preventDefault();
                        this.closest('form').submit();">
                        Logout
                        </button>
                    </form>
                    <button class="clickable btn" id="batal" onclick="modalLogoutToggle()">Batal</button>
                </div>
            </div>
        `;
    }
</script>
@yield('script')
</html>