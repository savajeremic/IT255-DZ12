import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppComponent } from './app.component';
import { HttpModule } from '@angular/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { routing } from './app.routing';

import { HomePageComponent } from './home/home.component';
import { AboutUsComponent } from './aboutus/aboutus.component';
import { RegisterComponent } from './register/register.component';
import { AddGameComponent } from './addgame/addgame.component';
import { AddClothingComponent } from './addclothing/addclothing.component';
import { LoginComponent } from './login/login.component';
import { AllGamesComponent } from './allgames/allgames.component';
import { SearchPipe } from './pipes/search';
import { SortGenre } from './pipes/sortGenre';
import { SortPegi } from './pipes/sortPegi';

@NgModule({
  declarations: [
    AppComponent,
    HomePageComponent,
    AboutUsComponent,
    RegisterComponent,
    AddGameComponent,
    AddClothingComponent,
    LoginComponent,
    AllGamesComponent,
    SearchPipe,
    SortGenre,
    SortPegi
  ],
  imports: [
    BrowserModule,
    HttpModule,
    routing,
    FormsModule,
    ReactiveFormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
