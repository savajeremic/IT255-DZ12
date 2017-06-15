import { Component, Directive } from '@angular/core';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import {Router} from '@angular/router';

@Component({
  selector: 'AllGamesComponent',
  templateUrl: './allgames.html'
})

export class AllGamesComponent {
  private data : Object[];
  private router: Router;

  constructor(private http: Http, router: Router) {
    this.router = router;
    var headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('token', localStorage.getItem('token'));
    http.get('http://localhost/it255/getgames.php', {headers: headers})
    .map(res => res.json()).share()
    .subscribe(
      data => {
        this.data = data.games;
      },
      err => {
        this.router.navigate(['./']);
      }
    );
  }
  public removeGame(event: Event, item: Number) {
    var headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('token', localStorage.getItem('token'));
    this.http.get('http://localhost/it255/deletegame.php?id='+item,{headers:headers})
    .subscribe(
      data => {
      event.srcElement.parentElement.parentElement.remove();
    });
  }

  public viewGame(item: Number){
    this.router.navigate(['/game', item]);
  }

  public editGame(id:number){
      this.router.navigateByUrl('editGame/' + id);
    }
}
