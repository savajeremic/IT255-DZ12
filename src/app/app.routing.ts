import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { HomePageComponent } from './home/home.component';
import { AboutUsComponent } from './aboutus/aboutus.component';
import { RegisterComponent } from './register/register.component';
import { LoginComponent } from './login/login.component';

import { AddGameComponent } from './addgame/addgame.component';
import { EditGameComponent } from './editgame/editgame.component';
import { AllGamesComponent } from './allgames/allgames.component';
import { GameComponent } from './game/game.component';

import { AddGameGenreComponent } from './addgamegenre/addgamegenre.component';
import { AllGameGenresComponent } from './allgamegenres/allgamegenres.component';

//import { AllGamesComponent } from './allgames/allgames.component';

const appRoutes: Routes = [
  { path: '', component: HomePageComponent },
  { path: 'aboutus', component: AboutUsComponent},
  { path: 'register', component: RegisterComponent},
  { path: 'login', component: LoginComponent},
  { path: 'addgame', component: AddGameComponent},
  { path: 'editGame/:id', component: EditGameComponent},
  { path: 'allgames', component: AllGamesComponent},
  { path: 'addgamegenre', component: AddGameGenreComponent},
  { path: 'allgamegenres', component: AllGameGenresComponent},
  { path: 'game/:id', component: GameComponent}
  //{ path: 'addclothing', component: AddClothingComponent},
];
export const routing: ModuleWithProviders = RouterModule.forRoot(appRoutes);
