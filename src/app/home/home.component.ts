import { Component,Directive } from '@angular/core';

import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';

@Component({
  selector: 'HomePage',
  templateUrl: './home.html'
})

export class HomePageComponent{
  private games = 'http://localhost/Angular/getGames.php';
  data: Object[];
  name: String = "";
    constructor (private http: Http){
      this.http.get(this.games).subscribe(
        data => {
          this.data = JSON.parse(data["_body"]);
        },
        err => console.log(err.text()),
          () => {
          }
        );
      }
}
