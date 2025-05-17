<style>
/* Reset Password Modal Styles */
.reset-pwd-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
}

/* Menampilkan modal saat menjadi target URL */
.reset-pwd-modal:target {
    display: block !important;
}

.reset-pwd-modal.show {
    display: block;
}

.reset-pwd-overlay {
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 10000;
    top: 0;
    left: 0;
}

.reset-pwd-container {
    position: relative;
    background-color: #fff;
    margin: 5% auto;
    padding: 25px;
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    z-index: 10001;
}

@media (max-width: 576px) {
    .reset-pwd-container {
        margin: 10% auto;
        padding: 20px;
        width: 95%;
    }
}

.reset-pwd-close {
    position: absolute;
    right: 15px;
    top: 10px;
    font-size: 24px;
    font-weight: bold;
    color: #777;
    cursor: pointer;
    text-decoration: none;
    transition: color 0.2s;
}

.reset-pwd-close:hover {
    color: #333;
}

/* Form styles */
.reset-pwd-header {
    margin-bottom: 20px;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
}

.reset-pwd-header h2 {
    color: #059652;
    margin: 0;
    font-size: 1.5rem;
}

.reset-pwd-content {
    padding: 10px 0;
}

.reset-pwd-group {
    margin-bottom: 20px;
}

.reset-pwd-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #333;
}

.reset-pwd-group input {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    transition: border-color 0.2s;
}

.reset-pwd-group input:focus {
    border-color: #059652;
    outline: none;
    box-shadow: 0 0 0 3px rgba(5, 150, 82, 0.1);
}

.reset-pwd-error {
    color: #e74c3c;
    font-size: 0.875rem;
    margin-top: 5px;
    display: block;
}

.reset-pwd-button {
    background-color: #059652;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
    transition: background-color 0.2s;
    width: 100%;
}

.reset-pwd-button:hover {
    background-color: #048247;
}

.reset-pwd-rules {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 20px;
    border-left: 3px solid #059652;
}

.reset-pwd-rules ul {
    margin-bottom: 0;
    padding-left: 20px;
}

.reset-pwd-rules li {
    margin-bottom: 5px;
}
/* Notifikasi Sukses */
.reset-pwd-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 10010;
    opacity: 0;
    transform: translateY(-20px);
    transition: opacity 0.3s, transform 0.3s;
}

.reset-pwd-notification.show {
    opacity: 1;
    transform: translateY(0);
}

.reset-pwd-notification-content {
    background-color: #059652;
    color: white;
    padding: 15px 20px;
    border-radius: 5px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    gap: 10px;
}

.reset-pwd-notification i {
    font-size: 20px;
}

/* Validasi Gaya */
.reset-pwd-group input.invalid {
    border-color: #e74c3c;
}

.reset-pwd-group input.valid {
    border-color: #059652;
}
</style>