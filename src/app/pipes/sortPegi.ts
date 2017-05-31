import {Pipe} from '@angular/core';

@Pipe({
  name: 'SortPegi'
})

export class SortPegi {
  transform(array: Array<number>): Array<number> {
    if(array)
    array.sort((a: number, b: number) => {
      if (a['pegi'] < b['pegi']) {
        return -1;
      } else if (a['pegi'] > b['pegi']) {
        return 1;
      } else {
        return 0;
      }
    });
    return array;
  }
}
