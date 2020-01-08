angular.module('app.product').factory('ProductService', ProductService);

ProductService.$inject = ['$http'];

function ProductService($http) {
    return {
        list: listProducts,
        delete: deleteProduct
    };

    function listProducts() {
        let url = '/api/products';
        return $http.get(url)
            .then(getListProductsComplete)
            .catch(getListProductsFailed)
        ;

        function getListProductsComplete(response) {
            return response.data;
        }

        function getListProductsFailed(error) {
            console.log('XHR Failed for `list products`. ' + error.data);
        }
    }

    function deleteProduct(id) {
        let url = ['/api/products', id].join('/');

        return $http.delete(url)
            .then(deleteProductComplete)
            .catch(deleteProductFailed)
        ;

        function deleteProductComplete() {
            return true;
        }

        function deleteProductFailed(error) {
            console.log('XHR Failed for `delete product`. ' + error.data);
        }
    }
}