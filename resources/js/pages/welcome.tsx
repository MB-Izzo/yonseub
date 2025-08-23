import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { MainLayout } from '@/layouts/main-layout';
import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <MainLayout title="Welcome on Yonseub">
                <h1>Hello world</h1>
                <Button variant={'secondary'}>Hello</Button>
            </MainLayout>
        </>
    );
}
