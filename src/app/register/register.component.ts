import { Component, Directive } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import {Router} from '@angular/router';

@Component({
  selector: 'RegisterComponent',
  templateUrl: './register.html',
})
export class RegisterComponent {
  http: Http;
  router: Router;
  postResponse: String;
  registerForm = new FormGroup({
    username: new FormControl(),
    password: new FormControl(),
    email: new FormControl(),
    ime: new FormControl(),
    prezime: new FormControl()
  });
  constructor(http: Http, router: Router) {
    this.http = http;
    this.router = router;

    if (localStorage.getItem('token') != null) {
      this.router.navigate(['./']);
    }
  }
  onRegister(): void {
    var data = "username=" + this.registerForm.value.username +
    "&password=" + this.registerForm.value.password +
    "&email=" + this.registerForm.value.email +
    "&ime=" + this.registerForm.value.ime +
    "&prezime=" + this.registerForm.value.prezime;
    let headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    this.http.post('http://localhost/it255/registerservice.php', data, {headers:headers})
    .map(res => res)
    .subscribe(
      data => {
        let obj = JSON.parse(data["_body"]);
        localStorage.setItem('token', obj.token);
        this.router.navigate(['./']);
      },
      err => {
        let obj = JSON.parse(err._body);
        let element = <HTMLElement> document.getElementsByClassName("alert")[0];
        element.style.display = "block";
        element.innerHTML = obj.error.split("\\r\\n").join("<br/>").split("\"").join("");
      }
    );
  }
}
