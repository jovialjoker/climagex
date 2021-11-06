import React from 'react';
import Authenticated from '@/Layouts/Authenticated';
import { Head } from '@inertiajs/inertia-react';
import Paginate from "@/Components/Paginate";
import Button from "@/Components/Button";
import {Inertia} from "@inertiajs/inertia";

export default function Dashboard(props) {
    const handleJoin = (evenimentId) => {
        if (confirm("Are you sure you want to join?")) {
            Inertia.post(route('participant.participate', evenimentId))
        }
    }

    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="grid grid-cols-4 grid-gaps-6 mx-auto sm:px-6 lg:px-12">
                    {
                        (props.auth.user.organization_id == null || !props.auth.user.organization_id) &&
                            <>
                                {
                            props.eveniments.data.map(eveniment => (
                                <div className="flex antialiased text-gray-900" key={eveniment.id}>
                                    <div>

                                        <img src={`/storage/eveniments/${eveniment.banner_picture}`} alt=" random imgee"
                                             className="object-cover object-center rounded-lg shadow-md" height="350" width="350" />

                                            <div className="relative px-4 -mt-16  ">
                                                <div className="bg-white p-6 rounded-lg shadow-lg">
                                                    <div className="flex items-baseline">
                                                      <span
                                                          className={`${eveniment.closed ? 'bg-red-500' : 'bg-green-500'} text-white text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide`}>
                                                        {eveniment.closed ? 'CLOSE' : 'OPEN'}
                                                      </span>
                                                        <div
                                                            className="ml-2 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                                                            {eveniment.users.length} current &bull; {eveniment.participants} total
                                                        </div>
                                                    </div>

                                                    <h4 className="mt-1 text-xl font-semibold uppercase leading-tight truncate">{eveniment.name}</h4>

                                                    <div>
                                                        <small className="text-gray-500">{eveniment.description}</small>
                                                    </div>
                                                    <div className="mt-4">
                                                        {
                                                            eveniment.users.length <= eveniment.participants && !eveniment.closed && !eveniment.users.some(user => user.id === props.auth.user.id)?
                                                            <Button className="bg-green-500" onClick={() => handleJoin(eveniment.id)}>Join this event</Button> :
                                                            <Button className="bg-gray-300">No joins allowed</Button>
                                                        }
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            ))
                                }

                                <Paginate links={props.eveniments.links} />
                            </>
                    }
                </div>
            </div>
        </Authenticated>
    );
}
