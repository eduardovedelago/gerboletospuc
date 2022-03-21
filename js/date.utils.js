Date.prototype.toDateInputValue = (function () {
    var local = new Date(this);
    //local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
});

Date.prototype.ddmmyyyy = function() {
    var mm = this.getMonth() + 1; // getMonth() is zero-based
    var dd = this.getDate();

    return [(dd>9 ? '' : '0') + dd + '/',
        (mm>9 ? '' : '0') + mm+'/',
        this.getFullYear()
    ].join('');
};

function getProximaDataVctoMes(dataBase){
    var dt = dataBase;
    dt.setMonth(dt.getMonth()+1);
    return dt;
}