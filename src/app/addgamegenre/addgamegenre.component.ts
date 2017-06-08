import { Component, Directive } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import { Observable } from 'rxjs/Observable';

import {Router} from '@angular/router';

@Component({
  selector: 'AddGameGenreComponent',
  templateUrl: './addgamegenre.html',
})
export class AddGameGenreComponent {
  http: Http;
  router: Router;
  postResponse: Response;
  addGameGenreForm = new FormGroup({
    name: new FormControl()
  });
  constructor(http: Http, router: Router) {
    this.http = http;
    this.router = router;
  }
  onAddGameGenre(): void {
    var data = "name=" + this.addGameGenreForm.value.name;
    var headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append("token",localStorage.getItem("token"));
    this.http.post('http://localhost/it255/addgamegenre.php',data,{headers:headers})
    .map(res => res)
    .subscribe(
      data => this.postResponse = data,
      err => alert(JSON.stringify(err)),
      () => {
        if(this.postResponse["_body"].indexOf("error") === -1){
          this.router.navigate(['./allgamegenres']);
        }else{
          alert("Neuspesno dodavanje zanra igrice");
        }
      }
    );
  }
}
