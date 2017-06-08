import { Component, Directive } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import { Router, ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'GameComponent',
  templateUrl: './game.html',
})
export class GameComponent {
  http: Http;
  router: Router;
  route: ActivatedRoute;
  data: Object[];

  constructor(route: ActivatedRoute, http: Http, router: Router) {
    this.http = http;
    this.router = router;
    this.route = route;
  }

  ngOnInit() {
    this.route.params.subscribe((params: Params) => {
      let id = params['id'];
      let headers = new Headers();
      headers.append('Content-Type', 'application/x-www-form-urlencoded');
      headers.append("token",localStorage.getItem("token"));
      this.http.get('http://localhost/it255/getgame.php?id='+id,{headers:headers})
      .map(res => res.json()).share()
      .subscribe(
        data => {
          this.data = data.data;
        },
        err => {
          this.router.navigate(['./']);
        }
      );
    });
  }
}
