{{-- Modal Konfirmasi Password --}}
<div id="confirmPasswordModal" class="reset-pwd-modal {{ session('password_modal') == 'confirm' ? 'show' : '' }}">
    <div class="modal-overlay reset-pwd-overlay"></div>
    <div class="reset-pwd-container">
        <a href="#" class="close-btn reset-pwd-close">&times;</a>
        <div class="reset-pwd-header">
            <h2>Konfirmasi Password</h2>
        </div>
        <div class="reset-pwd-content">
            <div class="text-center">
                <p>Mohon masukkan password Anda saat ini untuk konfirmasi identitas sebelum melakukan reset password.
                </p>
            </div>
            <form action="{{ route('password.confirm') }}" method="POST" id="confirmPasswordForm">
                @csrf
                <input type="hidden" name="redirect_to" value="{{ url()->current() }}#resetPasswordModal">
                <div class="reset-pwd-group">
                    <label for="current_password">Password Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" required
                        oninvalid="this.setCustomValidity('Harap isi password')" oninput="this.setCustomValidity('')">
                    @error('current_password')
                        <span class="reset-pwd-error">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="reset-pwd-button">Konfirmasi</button>
            </form>
        </div>
    </div>
</div>

{{-- Modal Reset Password --}}
<div id="resetPasswordModal" class="reset-pwd-modal {{ session('password_modal') == 'reset' ? 'show' : '' }}">
    <div class="modal-overlay reset-pwd-overlay"></div>
    <div class="reset-pwd-container">
        <a href="#" class="close-btn reset-pwd-close">&times;</a>
        <div class="reset-pwd-header">
            <h2>Reset Password</h2>
        </div>
        <div class="reset-pwd-content">
            <p>Silakan masukkan password baru Anda.</p>

            <div class="reset-pwd-rules">
                <p><strong>Password harus memenuhi kriteria berikut:</strong></p>
                <ul>
                    <li>Minimal 8 karakter</li>
                    <li>Mengandung huruf besar dan kecil</li>
                    <li>Mengandung angka</li>
                </ul>
            </div>

            <form action="{{ route('password.reset') }}" method="POST" id="resetPasswordForm">
                @csrf
                <div class="reset-pwd-group">
                    <label for="password">Password Baru</label>
                    <input type="password" id="password" name="password" required
                        oninvalid="this.setCustomValidity('Harap isi password baru')"
                        oninput="this.setCustomValidity('')">
                    @error('password')
                        <span class="reset-pwd-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="reset-pwd-group">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        oninvalid="this.setCustomValidity('Harap konfirmasi password baru')"
                        oninput="this.setCustomValidity('')">
                    @error('password_confirmation')
                        <span class="reset-pwd-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="reset-pwd-button">Reset Password</button>
            </form>
        </div>
    </div>
</div>
