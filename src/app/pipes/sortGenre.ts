import {Pipe} from '@angular/core';

@Pipe({
  name: 'SortGenre'
})

export class SortGenre {
  transform(array: Array<any>): Array<any> {
    if(array)
    array.sort((a: any, b: any) => {
      if (a['genre'] < b['genre']) {
        return -1;
      } else if (a['genre'] > b['genre']) {
        return 1;
      } else {
        return 0;
      }
    });
    return array;
  }
}
