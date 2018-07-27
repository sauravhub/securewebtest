function apiModifyTable(mainData,id,response){
    angular.forEach(mainData, function (product,key) {
        if(product.id == id){
            mainData[key] = response;
        }
    });
    return mainData;
}