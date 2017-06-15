import { Component, Directive } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import { Router, ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'EditGameComponent',
  templateUrl: `./editgame.html`,
})

export class EditGameComponent {
  http: Http;
  router: Router;
  postResponse: Response;
  route: ActivatedRoute;
  data: Object[];
  editGameForm = new FormGroup({
    gameName: new FormControl(),
    gamePegi: new FormControl(),
    gameGenreID: new FormControl(),
  });

   constructor(route: ActivatedRoute, http: Http, router: Router) {
    this.http = http;
    this.router = router;
    this.route = route;
    	if(localStorage.getItem('token') == null){
      		this.router.navigate(['']);
    	}
  	}

  onEditGame(): void {
  	  this.route.params.subscribe((params: Params) => {
	      let id = params['id'];
	      let headers = new Headers();
	      var data = "id=" + id + "&&gameName=" + this.editGameForm.value.gameName + "&&gamePegi=" + this.editGameForm.value.gamePegi + "&&gameGenreID=" + this.editGameForm.value.gameGenreID;
	      headers.append('Content-Type', 'application/x-www-form-urlencoded');
	      headers.append("token",localStorage.getItem("token"));
	      this.http.post('http://localhost/it255/editGame.php', data, { headers: headers })
	      .map(res => res)
	      .subscribe( data => this.postResponse = data,
	        err => alert(JSON.stringify(err)),
          () => {
	          if(this.postResponse["_body"].indexOf("error") === -1){
	            this.router.navigate(['./allgames']);
	          }else{
	            alert("Neuspesno editovanje igrice");
	          }
	        }
	      );
	  	}
	  	);
	}
}
