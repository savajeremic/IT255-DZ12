import { Component, Directive } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import { Observable } from 'rxjs/Observable';

import {Router} from '@angular/router';

@Component({
  selector: 'AddGameComponent',
  templateUrl: './addgame.html',
})
export class AddGameComponent {
  http: Http;
  router: Router;
  postResponse: Response;
  addGameForm = new FormGroup({
    gameName: new FormControl(),
    gameGenre: new FormControl(),
    gamePegi: new FormControl()
  });

  constructor(http: Http, router: Router) {
    this.http = http;
    this.router = router;
  }

  onAddGame(): void {
    var data = "gameName=" + this.addGameForm.value.gameName + "&gameGenre=" +
    this.addGameForm.value.gameGenre + "&gamePegi=" + this.addGameForm.value.gamePegi;
    var headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append("token", localStorage.getItem("token"));
    this.http.post('http://localhost/it255/addgame.php', data, {headers:headers})
    .map(res => res)
    .subscribe(
      data => this.postResponse = data,
      err => alert(JSON.stringify(err)),
      () => {
        if(this.postResponse["_body"].indexOf("error") === -1){
          this.router.navigate(['./allgames']);
        } else{
          alert("Neuspesno dodavanje igre");
        }
      }
    );
  }
}
