document.getElementById('type').addEventListener('change', function () {
    let deceasedDiv = document.getElementById('deceased_div');
    let donor = document.getElementById('donor_name');
    let mobile = document.getElementById('mobile');

    if (this.value === 'after_death') {
        deceasedDiv.style.display = 'block';
        donor.readOnly = true;
        mobile.readOnly = true;
    } else {
        deceasedDiv.style.display = 'none';
        donor.readOnly = false;
        mobile.readOnly = false;
    }
});

// Fetch deceased details
document.querySelector('select[name="deceased_id"]').addEventListener('change', function () {
    let id = this.value;

    if (id) {
        fetch("{{ url('get-deceased') }}/" + id)
            .then(res => res.json())
            .then(data => {

                document.getElementById('deceased_details').style.display = 'block';

                document.getElementById('d_name').innerText = data.deathperson_name ?? '-';
                document.getElementById('d_age').innerText = data.age ?? '-';
                document.getElementById('d_dod').innerText = data.date_of_death ?? '-';
                document.getElementById('d_cdate').innerText = data.cremation_date ?? '-';
                document.getElementById('d_relative').innerText = data.relative_name ?? '-';

                // Autofill
                document.getElementById('donor_name').value = data.relative_name ?? '';
                document.getElementById('mobile').value = data.mobile ?? '';
            });
    }
});

// Amount → Words
document.getElementById('amount').addEventListener('input', function () {
    let val = parseInt(this.value);
    document.getElementById('amount_in_word').value =
        val ? numberToWords(val) : '';
});

// Same function from before
function numberToWords(num) {
    const ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
    const tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

    function convert(n) {
        let str = '';
        if (n >= 100) {
            str += ones[Math.floor(n / 100)] + ' Hundred ';
            n %= 100;
        }
        if (n >= 20) {
            str += tens[Math.floor(n / 10)] + ' ';
            n %= 10;
        }
        if (n > 0) {
            str += ones[n] + ' ';
        }
        return str;
    }

    let result = '';
    if (num >= 10000000) {
        result += convert(Math.floor(num / 10000000)) + 'Crore ';
        num %= 10000000;
    }
    if (num >= 100000) {
        result += convert(Math.floor(num / 100000)) + 'Lakh ';
        num %= 100000;
    }
    if (num >= 1000) {
        result += convert(Math.floor(num / 1000)) + 'Thousand ';
        num %= 1000;
    }
    if (num > 0) {
        result += convert(num);
    }

    return 'Rupees ' + result.trim() + 'Only';
}

document.querySelector('select[name="deceased_id"]').dispatchEvent(new Event('change'));



// Auto convert
document.getElementById('amount').addEventListener('input', function () {
    let value = parseInt(this.value);
    document.getElementById('amount_in_word').value =
        value ? numberToWords(value) : '';
});

document.getElementById('type').addEventListener('change', function () {
    document.getElementById('deceased_div').style.display =
        this.value === 'after_death' ? 'block' : 'none';
});