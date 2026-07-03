function showMsg(el, text, type) {
    el.textContent = text;
    el.className = "msg show " + type;
}

function showFieldError(el, text) {
    if (!el) return;
    el.textContent = text;
    el.style.display = text ? "block" : "none";
}

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

document.getElementById("loginForm")?.addEventListener("submit", function (e) {
    e.preventDefault();
    const username = document.getElementById("loginUsername").value.trim();
    const password = document.getElementById("loginPassword").value;
    const msgEl = document.getElementById("loginMsg");

    if (!username || !password) {
        showMsg(msgEl, "Please enter both username and password.", "error");
        return;
    }

    const formData = new FormData();
    formData.append("username", username);
    formData.append("password", password);

    fetch("login.php", { method: "POST", body: formData })
        .then((res) => res.json())
        .then((data) => {
            if (data.status === "success") {
                showMsg(msgEl, "Welcome, " + data.full_name + "!", "success");
            } else {
                showMsg(msgEl, data.message, "error");
            }
        })
        .catch(() => showMsg(msgEl, "Something went wrong. Please try again.", "error"));
});

document.getElementById("registerForm")?.addEventListener("submit", function (e) {
    e.preventDefault();

    const fullName = document.getElementById("regFullName").value.trim();
    const username = document.getElementById("regUsername").value.trim();
    const email = document.getElementById("regEmail").value.trim();
    const password = document.getElementById("regPassword").value;
    const confirmPassword = document.getElementById("regConfirmPassword").value;
    const msgEl = document.getElementById("registerMsg");

    let valid = true;

    if (fullName.length < 3) {
        showFieldError(document.getElementById("errFullName"), "Full name must be at least 3 characters.");
        valid = false;
    } else showFieldError(document.getElementById("errFullName"), "");

    if (username.length < 4) {
        showFieldError(document.getElementById("errUsername"), "Username must be at least 4 characters.");
        valid = false;
    } else showFieldError(document.getElementById("errUsername"), "");

    if (!isValidEmail(email)) {
        showFieldError(document.getElementById("errEmail"), "Enter a valid email address.");
        valid = false;
    } else showFieldError(document.getElementById("errEmail"), "");

    if (password.length < 6) {
        showFieldError(document.getElementById("errPassword"), "Password must be at least 6 characters.");
        valid = false;
    } else showFieldError(document.getElementById("errPassword"), "");

    if (password !== confirmPassword) {
        showFieldError(document.getElementById("errConfirmPassword"), "Passwords do not match.");
        valid = false;
    } else showFieldError(document.getElementById("errConfirmPassword"), "");

    if (!valid) {
        showMsg(msgEl, "Please fix the errors above.", "error");
        return;
    }

    const formData = new FormData();
    formData.append("full_name", fullName);
    formData.append("username", username);
    formData.append("email", email);
    formData.append("password", password);

    fetch("register.php", { method: "POST", body: formData })
        .then((res) => res.json())
        .then((data) => {
            if (data.status === "success") {
                showMsg(msgEl, data.message, "success");
                document.getElementById("registerForm").reset();
            } else {
                showMsg(msgEl, data.message, "error");
            }
        })
        .catch(() => showMsg(msgEl, "Something went wrong. Please try again.", "error"));
});

document.getElementById("resetForm")?.addEventListener("submit", function (e) {
    e.preventDefault();

    const email = document.getElementById("resetEmail").value.trim();
    const newPassword = document.getElementById("resetNewPassword").value;
    const msgEl = document.getElementById("resetMsg");

    if (!isValidEmail(email)) {
        showMsg(msgEl, "Please enter a valid registered email address.", "error");
        return;
    }
    if (newPassword.length < 6) {
        showMsg(msgEl, "New password must be at least 6 characters.", "error");
        return;
    }

    const formData = new FormData();
    formData.append("email", email);
    formData.append("new_password", newPassword);

    fetch("reset_password.php", { method: "POST", body: formData })
        .then((res) => res.json())
        .then((data) => {
            showMsg(msgEl, data.message, data.status === "success" ? "success" : "error");
            if (data.status === "success") document.getElementById("resetForm").reset();
        })
        .catch(() => showMsg(msgEl, "Something went wrong. Please try again.", "error"));
});