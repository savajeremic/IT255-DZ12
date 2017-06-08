import { Component, Directive } from '@angular/core';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import {Router} from '@angular/router';

@Component({
  selector: 'AllGameGenresComponent',
  templateUrl: './allgamegenres.html'
})

export class AllGameGenresComponent {
  private data : Object[];
  private router: Router;

  constructor(private http: Http, router: Router) {
    this.router = router;
    var headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('token', localStorage.getItem('token'));
    http.get('http://localhost/it255/getgamegenres.php', {headers: headers})
    .map(res => res.json()).share()
    .subscribe(
      data => {
        this.data = data.gamegenres;
      },
      err => {
        this.router.navigate(['./']);
      }
    );
  }

  public removeGameGenre(event: Event, item: Number) {
    var headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('token', localStorage.getItem('token'));
    this.http.get('http://localhost/it255/deletegamegenre.php?id='+
    item,{headers:headers}) .subscribe(
      data => {
        event.srcElement.parentElement.parentElement.remove();
    });
  }
}
