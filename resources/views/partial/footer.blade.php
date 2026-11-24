<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Mediva" class="footer-logo">
            <p class="footer-description">
                Klinik digital terpercaya untuk konsultasi kesehatan di Plaju.
            </p>
            <p class="footer-adress">
                Mediva Pusat: Plaju, Palembang.<br>
                Cabang Kami:
                <span>Mediva Unsri Bukit</span>
                <span>Mediva Unsri Indralaya</span>
            </p>
        </div>

        <div class="footer-col">
            <h4>FITUR</h4>
            <ul>
                <li><a href="{{ url('/chat') }}">Chat dengan Dokter</a></li>
                <li><a href="{{ url('/pharmacy') }}">Toko Kesehatan</a></li>
                <li><a href="{{ url('/patient/appointments') }}">Jadwal Janji Temu</a></li>
                <li><a href="{{ url('/login') }}">Berobat Sekarang</a></li>
            </ul>
        </div>
        
        <div class="footer-col">
            <h4>TENTANG KAMI</h4>
            <ul>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Status</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
            </ul>
        </div>

        <div class="footer-map-area">
            <div class="footer-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3984.3316768183886!2d104.80148207351408!3d-3.005136639917597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zM8KwMDAnMTguNSJTIDEwNMKwNDgnMTQuNiJF!5e0!3m2!1sid!2sid!4v1793695284900!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
            </div>
        </div>

        <p class="footer-copyright">
            &copy; 2026 Mediva. All rights reserved.
        </p>
    </div>