angular.module('app.product').controller('ProductController', ProductController);

ProductController.$inject = ['ProductService']

function ProductController(ProductService) {
    /* virtual model */
    let vm = this;

    vm.list = [];
    vm.delete = deleteProduct;

    init();

    function init() {
        return ProductService.list().then(function(data) {
            vm.list = data;

            return vm.list;
        });
    }

    function deleteProduct(id, index) {
        return ProductService.delete(id).then(function(data) {
            vm.list.splice(index, 1);
        });
    }
}