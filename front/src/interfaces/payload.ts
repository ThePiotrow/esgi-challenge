export interface SigninI {
	email: string
	password: string
}

export interface SignupI {
	username: string
	email: string
	password: string
}

export interface UserI {
	id?: string
	email: string
	username: string
	roles: string[]
	emailValidated: boolean
}

export interface TokenI {
	token: string
}

export interface FighterI {
	id?: string
	firstname: string
	lastname: string
	height: number
	weight: number
	nationality: string
	gender: string
	birthdate: string
}

export interface EventI {
	id?: string
	name: string
	location: string
	description: string
	image: string
	capacity: number
	category: string
	fight: FightI[]
	locationLink: string
	startTimestamp: string 
	endTimestamp: string
}

export interface FightI {
	fighterA: FighterI
	fighterB: FighterI
	eventId: string
	winner: FighterI
	looser: FighterI
}

export interface FightBetI {
	id?: string
	fightId: string
	amount: number
	bet_on: string
	bet_user: string
}