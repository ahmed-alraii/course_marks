function confirmDelete(title, message, yes, no, myform) {
    alertify
        .confirm(
            title,
            message,
            function () {
                myform.form.submit();
            },
            function () {}
        )
        .set("labels", { ok: yes, cancel: no });
}
