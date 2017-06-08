import { Component, Directive } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import { Router, ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'EditGameComponent',
  templateUrl: './editgame.html',
})
export class EditGameComponent {
  http: Http;
  router: Router;
  route: ActivatedRoute;
  data: Object[];
  editGameForm = new FormGroup({
    gameName: new FormControl(),
    gamePegi: new FormControl()
  });

  constructor(route: ActivatedRoute, http: Http, router: Router) {
    this.http = http;
    this.router = router;
    this.route = route;
  }
  onEditGame(): void {
    this.route.params.subscribe((params: Params) => {
      let id = params['id'];
      let headers = new Headers();
      var data = id + "id" +"gameName=" + this.editGameForm.value.gameName +
      "&gamePegi=" + this.editGameForm.value.gamePegi
      headers.append('Content-Type', 'application/x-www-form-urlencoded');
      headers.append("token",localStorage.getItem("token"));
      this.http.get('http://localhost/it255/editgame.php',{headers:headers})
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
