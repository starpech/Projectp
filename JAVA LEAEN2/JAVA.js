function getPyramit (length, width, height){
    let baseArea = length * width;
    let pyramidVolume = 1/3 * baseArea * height;
    return pyramidVolume;
}
let x = 2
let y = 2
let z = 3

let area1 = getPyramit(x,y,z);
console.log('area 1 = '+ area1);