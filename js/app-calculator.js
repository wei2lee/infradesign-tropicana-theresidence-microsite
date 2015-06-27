var app = angular.module('CalculatorApp', []);

app.controller('CalculatorCtrlr', function ($scope) {
    $scope.purchaseprice = '';
    $scope.downpayment = '';
    $scope.loanrate = '';
    $scope.tenureyear = '';

    $scope.loanamount = function () {
        return this.purchaseprice - this.downpayment;
    };

    $scope.payablepermonth = function () {
        var ret = (this.interestpermonth() * this.effectiveinterest() * this.loanamount()) / (this.effectiveinterest() - 1);
        if (isNaN(ret)) ret = 0;
        return ret;
    };

    $scope.totalpayment = function () {
        return this.payablepermonth() * this.tenureyear * 12;
    };

    $scope.interestpermonth = function () {
        return this.loanrate / 100 / 12;
    };

    $scope.effectiveinterest = function () {
        return Math.pow(1 + this.interestpermonth(), this.tenureyear * 12);
    };
});